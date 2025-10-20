<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showCheckoutForm()
    {
        if (!Session::has('cart') || empty(Session::get('cart'))) {
            return redirect()->route('frontend.cart')->with('error', 'Giỏ hàng trống.');
        }

        return view('frontend.checkout');
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sdt' => 'required|string|max:15',
            'diachi' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|in:cod,vnpay',
        ]);

        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Giỏ hàng trống.');
        }

        $total = collect($cart)->sum(fn($item) => $item['giasp'] * $item['quantity']);

        // Kiểm tra tổng tiền
        if ($total <= 0 || abs($total - $request->amount) > 1) {
            return redirect()->route('frontend.checkout')->with('error', 'Tổng tiền không hợp lệ.');
        }

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'sdt' => $request->input('sdt'),
            'diachi' => $request->input('diachi'),
            'payment_method' => $request->payment_method,
            'tongtien' => $total,
            'trang_thai' => 'Chờ xác nhận',
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' =>  $item['id'],
                'ten_sanpham' => $item['ten_sanpham'],
                'soluong' => $item['quantity'],
                'giasp' => $item['giasp'],
                'tongtien' => $item['giasp'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('frontend.lichsu.history')->with('success', 'Đặt hàng thành công!');
    }

    public function history()
    {
        $id = Auth::id();

        $orders = Order::where('user_id', $id)->orderByDesc('created_at')->get();

        return view('frontend.lichsu.history', compact('orders'));
    }

    public function detail($order_id)
    {
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('frontend.lichsu.history')->with('error', 'Không tìm thấy đơn hàng.');
        }

        $orderDetails = OrderDetail::where('order_id', $order_id)->get();

        return view('frontend.lichsu.showls', compact('order', 'orderDetails'));
    }
}
