<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên
        if ($request->filled('search')) {
            $query->where('ten_sanpham', 'like', '%' . $request->search . '%');
        }

        // Lọc theo tồn kho thấp (mặc định < 10)
        if ($request->filled('low_stock')) {
            $threshold = $request->input('low_stock_threshold', 10);
            $query->where('stock', '<=', $threshold);
        }

        $products = $query->orderBy('stock', 'asc')->paginate(20)->withQueryString();

        return view('backend.stock.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $oldStock = $product->stock;
        $product->stock = $request->stock;
        $product->save();

        return back()->with('success', "Cập nhật tồn kho cho \"{$product->ten_sanpham}\" từ {$oldStock} thành {$request->stock}");
    }
}
