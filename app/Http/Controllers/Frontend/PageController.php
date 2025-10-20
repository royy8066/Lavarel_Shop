<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function page1(){
        $products = Product::paginate(8);
        return view('frontend.page.page1', compact('products'));
    }

    public function page2(){
        $products = Product::paginate(8);
        return view('frontend.page.page2', compact('products'));
    }

    public function page3(){
        $products = Product::paginate(8);
        return view('frontend.page.page3', compact('products'));
    }

    public function page4(){
        $products = Product::paginate(8);
        return view('frontend.page.page4', compact('products'));
    }
}
