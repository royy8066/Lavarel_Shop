<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'guest_name' => 'required_if:user_id,null|string|max:255',
            'guest_email' => 'required_if:user_id,null|email|max:255',
        ]);

        $product = Product::findOrFail($productId);

        $comment = Comment::create([
            'content' => $request->content,
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'ip_address' => $request->ip(),
            'is_approved' => true, // Auto approve for now, can be changed to require admin approval
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
    }

    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        
        // Check if user already liked (using session for guest users)
        $likedKey = 'comment_liked_' . $commentId;
        if (Session::has($likedKey)) {
            return response()->json(['success' => false, 'message' => 'Bạn đã thích bình luận này rồi!']);
        }

        $comment->increment('likes');
        Session::put($likedKey, true);

        return response()->json([
            'success' => true,
            'likes' => $comment->fresh()->likes
        ]);
    }
}
