<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HometimeController extends Controller
{
    public function __construct(){

    }

    public function index(){
        return view('frontend.index');
    }

    public function blog(){
        return view('frontend.blog');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function news(){
        return view('frontend.news');
    }

    public function news1(){
        return view('frontend.tintuc.news1');
    }

    public function profile(){
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:login,email,' . $user->id,
            'password' => 'nullable|min:1|confirmed',
        ]);

        $user->fullname = $request->fullname;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('frontend.profile')->with('success', 'Cập nhật thành công!');
    }
}
