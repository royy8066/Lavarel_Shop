<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'tinh' => 'required|string|max:255',
            'quan_huyen' => 'required|string|max:255',
            'xa_phuong' => 'required|string|max:255',
            'dia_chi_chi_tiet' => 'required|string|max:255',
            'diachi' => 'required|string|max:500',
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|in:cod,vnpay,momo',
        ]);

        // Kiểm tra OTP verification
        $email = $request->input('email');
        $otpVerified = session('otp_verified_' . $email, false);
        if (!$otpVerified) {
            return redirect()->route('frontend.checkout')->with('error', 'Vui lòng xác thực OTP trước khi thanh toán.');
        }

        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Giỏ hàng trống.');
        }

        // Kiểm tra tồn kho
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('frontend.cart')->with('error', "Sản phẩm #{$id} không tồn tại.");
            }
            if ($product->stock < $item['quantity']) {
                return redirect()->route('frontend.cart')->with('error', "Sản phẩm \"{$product->ten_sanpham}\" chỉ còn {$product->stock} sản phẩm trong kho.");
            }
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
            'tinh' => $request->input('tinh'),
            'quan_huyen' => $request->input('quan_huyen'),
            'xa_phuong' => $request->input('xa_phuong'),
            'dia_chi_chi_tiet' => $request->input('dia_chi_chi_tiet'),
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

            // Trừ tồn kho
            $product = Product::find($item['id']);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');

        // Gửi hóa đơn qua email
        try {
            $invoiceService = new InvoiceService();
            $invoiceService->sendInvoiceByEmail($order);
        } catch (\Exception $e) {
            \Log::error('Send invoice failed: ' . $e->getMessage());
            // Không fail order nếu gửi email thất bại
        }

        // Nếu user đã đăng nhập, redirect về lịch sử
        if (Auth::check()) {
            return redirect()->route('frontend.lichsu.history')->with('success', 'Đặt hàng thành công!');
        }

        // Nếu user chưa đăng nhập, lưu order_id vào session và redirect về trang xác nhận
        session(['order_id' => $order->id, 'order_email' => $order->email]);
        return redirect()->route('frontend.order.confirmation')->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email để xác nhận đơn hàng.');
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

    public function downloadInvoice(Order $order)
    {
        // Detect language preference
        $invoiceService = new InvoiceService();
        $lang = $invoiceService->detectLanguage($order);
        $isEnglish = $lang === 'en';
        
        // Chỉ cho phép chủ đơn hàng hoặc admin tải
        if (Auth::check() && (Auth::id() === $order->user_id || Auth::user()->is_admin ?? false)) {
            $view = $isEnglish ? 'frontend.invoice_en' : 'frontend.invoice';
            $pdf = Pdf::loadView($view, compact('order'));
            $fileName = 'invoice_' . $order->id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';
            return $pdf->download($fileName);
        }

        // Nếu chưa đăng nhập, chỉ cho phép trong 1 giờ sau khi đặt hàng
        if (!Auth::check() && $order->created_at->diffInHours(now()) < 1) {
            $view = $isEnglish ? 'frontend.invoice_en' : 'frontend.invoice';
            $pdf = Pdf::loadView($view, compact('order'));
            $fileName = 'invoice_' . $order->id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';
            return $pdf->download($fileName);
        }

        abort(403, 'Bạn không có quyền tải hóa đơn này.');
    }

    public function confirmation()
    {
        $orderId = request('order_id') ?: session('order_id');
        $orderEmail = request('order_email') ?: session('order_email');

        if (!$orderId) {
            return redirect()->route('frontend.index')->with('error', 'Không tìm thấy thông tin đơn hàng.');
        }

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('frontend.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        $orderDetails = OrderDetail::where('order_id', $orderId)->get();

        return view('frontend.order.confirmation', compact('order', 'orderDetails'));
    }
}
