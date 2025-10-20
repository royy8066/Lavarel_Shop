<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart() {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['giasp'] * $item['quantity']);
        return view('frontend.cart', compact('cart', 'total'));
    }
    
    public function addcart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "id" => $product->id, 
                "ten_sanpham" => $product->ten_sanpham,
                "giasp" => $product->giasp,
                "img" => $product->img,
                "quantity" => $quantity
            ];
        }
    
        session()->put('cart', $cart);
        return redirect()->route('frontend.cart')->with('success', 'Đã thêm vào giỏ hàng!');
    }
    
    public function updatesp(Request $request, $id) {
        $cart = session()->get('cart');
        if ($cart && isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->product_quantity;
            session()->put('cart', $cart);
        }
        return redirect()->route('frontend.cart')->with('success', 'Giỏ hàng đã được cập nhật');
    }
    
    public function removesp($id) {
        $cart = session()->get('cart');
        if ($cart && isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('frontend.cart')->with('success', 'Xóa sản phẩm thành công!');
    }
}
