<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;



class DanhmucController extends Controller
{
    public function __construct(){

    }

    public function adddanhmuc(Request $request){
        return view('backend.category.adddanhmuc');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_danhmuc' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create([
            'ten_danhmuc' => $request->ten_danhmuc,
        ]);

        return redirect()->route('backend.category.showdanhmuc')->with('success', 'Thêm danh mục thành công!');
    }

    public function showdanhmuc(Request $request){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.category.showdanhmuc', compact('categories'));
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.editdanhmuc', compact('category'));
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('backend.category.showdanhmuc')->with('success', 'Xóa danh mục thành công!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'ten_danhmuc' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'ten_danhmuc' => $request->ten_danhmuc,
        ]);
        return redirect()->route('backend.category.showdanhmuc')->with('success', 'Cập nhật danh mục thành công!');
    }


}
