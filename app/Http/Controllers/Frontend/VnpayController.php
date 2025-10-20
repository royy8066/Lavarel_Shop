<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VnpayController extends Controller
{
    public function vnpay(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sdt' => 'required|string|max:15',
            'diachi' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
        ]);

        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Giỏ hàng trống.');
        }

        $total = collect($cart)->sum(fn($item) => $item['giasp'] * $item['quantity']);

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
            'payment_method' => 'vnpay',
            'tongtien' => $total,
            'trang_thai' => 'Chờ thanh toán',
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'ten_sanpham' => $item['ten_sanpham'],
                'soluong' => $item['quantity'],
                'giasp' => $item['giasp'],
                'tongtien' => $item['giasp'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "A14PSLXG";
        $vnp_HashSecret = "PYJDWRBJMUTHU8XQVUU07B2H1YWNUY93";

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = "Thanh toan hóa đơn" . $order->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    public function vnpayReturn(Request $request)
    {
        // Kiểm tra mã hash để xác thực dữ liệu (bảo mật)
        $vnp_HashSecret = "PYJDWRBJMUTHU8XQVUU07B2H1YWNUY93"; // dùng đúng secret của bạn
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = '';
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $orderId = $request->vnp_TxnRef;
                $order = Order::find($orderId);

                if ($order && $order->trang_thai == 'Chờ thanh toán') {
                    $order->trang_thai = 'Thanh toán thành công';
                    $order->save();

                    session()->forget('cart');
                }
                return view('frontend.vnpay.success');
            } else {
                return view('frontend.vnpay.failed');
            }
        } else {
            return "Invalid signature!";
        }
    }
}