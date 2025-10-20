<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class SanphamController extends Controller
{
    public function __construct(){

    }

    public function addsanpham(Request $request){
        $category = Category::all();
        return view('backend.product.addsanpham', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_sanpham' => 'required',
            'giasp' => 'required|numeric',
            'danhmuc_id' => 'required|exists:category,id',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'mota' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('uploads', 'public');
        }

        Product::create([
            'ten_sanpham' => $request->ten_sanpham,
            'giasp' => $request->giasp,
            'danhmuc_id' => $request->danhmuc_id,
            'img' => $imagePath,
            'mota' => $request->mota,
            'status' => $request->status ?? 1,
        ]);
        return redirect()->route('backend.product.addsanpham')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function showsanpham(Request $request){
        $product = Product::orderBy('id', 'desc')->get();
        return view('backend.product.showsanpham', compact('product'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('backend.product.editsanpham', compact('product', 'category'));
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('backend.product.showsanpham')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'ten_sanpham' => 'required',
            'giasp' => 'required|numeric',
            'danhmuc_id' => 'required|exists:category,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mota' => 'required',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('uploads', 'public');
            $product->img = $imagePath;
        }

        $product->update([
        'ten_sanpham' => $request->ten_sanpham,
        'giasp' => $request->giasp,
        'danhmuc_id' => $request->danhmuc_id,
        'mota' => $request->mota,
        'status' => $request->status ?? 1,
    ]);
        return redirect()->route('backend.product.showsanpham')->with('success', 'Cập nhật sản phẩm thành công!');
    }


}
