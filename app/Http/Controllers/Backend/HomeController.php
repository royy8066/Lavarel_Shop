<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function index()
    {
        $tongDonHang = Order::count();
        $tongDoanhThu = Order::whereIn('trang_thai', ['Đơn hàng đã được gửi đi', 'Thanh toán thành công'])->sum('tongtien');
        $donCho = Order::where('trang_thai', 'Chờ xác nhận')->count();
        $donXacNhan = Order::where('trang_thai', 'Đơn hàng đã được gửi đi')->count();
        $tongSanPham = Product::count();

        $namHienTai = Carbon::now()->year;
        $dataChart = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(tongtien) as total')
            )
            ->whereYear('created_at', $namHienTai)
            ->where('trang_thai', 'Đơn hàng đã được gửi đi')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $labels = [];
        $doanhThuData = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = 'Tháng ' . $i;
            $thang = $dataChart->firstWhere('month', $i);
            $doanhThuData[] = $thang ? $thang->total : 0;
        }

        return view('backend.index', compact(
            'tongDoanhThu', 'tongDonHang', 'donCho', 'donXacNhan',
            'tongSanPham', 'labels', 'doanhThuData'
        ));
    }

    public function profile(){
        $admin = Auth::user();
        return view('backend.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:1|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('backend.profile')->with('success', 'Cập nhật thành công!');
    }
}
