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

        // Tính tỷ lệ tăng trưởng (so với tháng trước)
        $thangTruoc = Carbon::now()->subMonth();
        $doanhThuThangTruoc = Order::whereMonth('created_at', $thangTruoc->month)
            ->whereYear('created_at', $thangTruoc->year)
            ->whereIn('trang_thai', ['Đơn hàng đã được gửi đi', 'Thanh toán thành công'])
            ->sum('tongtien');
        
        $thangHienTai = Carbon::now();
        $doanhThuThangHienTai = Order::whereMonth('created_at', $thangHienTai->month)
            ->whereYear('created_at', $thangHienTai->year)
            ->whereIn('trang_thai', ['Đơn hàng đã được gửi đi', 'Thanh toán thành công'])
            ->sum('tongtien');
        
        $tangTruong = $doanhThuThangTruoc > 0 
            ? round((($doanhThuThangHienTai - $doanhThuThangTruoc) / $doanhThuThangTruoc) * 100, 1)
            : 0;

        // Lấy dữ liệu biểu đồ 12 tháng gần nhất
        $dataChart = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(tongtien) as total')
            )
            ->whereIn('trang_thai', ['Đơn hàng đã được gửi đi', 'Thanh toán thành công'])
            ->where('created_at', '>=', Carbon::now()->subMonths(11))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Tạo mảng dữ liệu cho 12 tháng
        $chartData = [];
        $labels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;
            
            $labels[] = 'T' . $month . '/' . substr($year, -2);
            
            $monthData = $dataChart->where('month', $month)->where('year', $year)->first();
            $chartData[] = $monthData ? (int)$monthData->total : 0;
        }

        // Lấy sản phẩm bán chạy nhất
        $topProducts = DB::table('order_details')
            ->join('product', 'order_details.product_id', '=', 'product.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(
                'product.ten_sanpham',
                DB::raw('SUM(order_details.soluong) as total_sold'),
                DB::raw('COUNT(order_details.id) as order_count')
            )
            ->whereIn('orders.trang_thai', ['Đơn hàng đã được gửi đi', 'Thanh toán thành công'])
            ->where('orders.created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('product.id', 'product.ten_sanpham')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        return view('backend.index', compact(
            'tongDoanhThu', 'tongDonHang', 'donCho', 'donXacNhan',
            'tongSanPham', 'tangTruong', 'labels', 'chartData', 'topProducts'
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
