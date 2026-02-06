<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product(){
        $products = Product::where('danhmuc_id', 1)->paginate(8);
        return view('frontend.sanpham.product', compact('products'));
    }

    public function product2(){
        $products = Product::where('danhmuc_id', 2)->paginate(8);
        return view('frontend.sanpham.product2', compact('products'));
    }

    public function product3(){
        $products = Product::where('danhmuc_id', 3)->paginate(8);
        return view('frontend.sanpham.product3', compact('products'));
    }
    
    public function product4(){
        $products = Product::where('danhmuc_id', 4)->paginate(8);
        return view('frontend.sanpham.product4', compact('products'));
    }

    public function productdetail($id){
        $product = Product::findOrFail($id);
        $comments = $product->approvedComments()->paginate(10);
        return view('frontend.productdetail', compact('product', 'comments'));
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');

        $products = Product::where('ten_sanpham', 'LIKE', "%$keyword%")
                        ->orWhere('mota', 'LIKE', "%$keyword%")
                        ->paginate(8);

        return view('frontend.search', compact('products', 'keyword'));
    }

}
