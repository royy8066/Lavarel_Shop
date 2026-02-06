<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoiceMail;

class MomoController extends Controller
{
    // MoMo API configuration
    private $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    private $partnerCode = 'MOMOBKUN20180529';
    private $accessKey = 'klm05TvNBzhg7h7j';
    private $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    public function momo(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sdt' => 'required|string|max:10',
            'diachi' => 'required|string|max:255',
            'tinh' => 'required|string|max:255',
            'xa_phuong' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
        ]);

        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Giỏ hàng trống.');
        }

        // Refresh cart items price/title/img from DB to ensure invoice matches current prices
        foreach ($cart as $id => $item) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $cart[$id]['giasp'] = $product->giasp;
                $cart[$id]['ten_sanpham'] = $product->ten_sanpham;
                $cart[$id]['img'] = $product->img;
            }
        }
        session()->put('cart', $cart);

        $total = collect($cart)->sum(fn($item) => $item['giasp'] * $item['quantity']);

        // Create order
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
            'tinh' => $request->tinh,
            'xa_phuong' => $request->xa_phuong,
            'payment_method' => 'momo',
            'tongtien' => $total,
            'trang_thai' => 'Chờ thanh toán',
        ]);

        // Create order details
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

        // Save order_id to session for non-logged-in users
        if (!Auth::check()) {
            session(['order_id' => $order->id, 'order_email' => $order->email]);
        }

        session()->forget('cart');

        // Prepare MoMo payment request
        $requestId = time() . rand(1000, 9999);
       // $requestType = "payWithATM";
        $requestType = "captureWallet";
        $orderId = $order->id . rand(1000, 9999);
        $orderInfo = "Thanh toán đơn hàng #" . $order->id;
        $amount = (int)$total;
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.ipn');
        $extraData = $order->id . "";
        $bankCode = $request->input('bankCode');
        
        // Lưu momo_txn_ref để track
        $order->update(['momo_txn_ref' => $requestId]);

        // Create signature
        $rawHash = "accessKey=" . $this->accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'partnerName' => "Trầm Hương Tiên Phước",
            'storeId' => "MomoStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        if (!empty($bankCode)) {
            $data['bankCode'] = $bankCode;
        }

        Log::info('MoMo Request Data', $data);
        $result = $this->execPostRequest($this->endpoint, json_encode($data));
        Log::info('MoMo Raw Response', ['response' => $result]);
        $jsonResult = json_decode($result, true);

        Log::info('MoMo Response', $jsonResult ?? []);

        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
        } else {
            return redirect()->route('frontend.checkout')->with('error', 'Lỗi khi kết nối với MoMo. Vui lòng thử lại.');
        }
    }

    public function momoReturn(Request $request)
    {
        $resultCode = $request->get('resultCode');
        $orderId = $request->get('orderId');
        $extraData = $request->get('extraData');

        Log::info('MoMo Return', $request->all() ?? []);

        // Extract real order ID from extraData (lưu order_id thực trong extraData)
        $realOrderId = $extraData ?: substr($orderId, 0, strlen($orderId) - 4);

        if ($resultCode == 0) {
            // Payment successful
            $order = Order::find($realOrderId);
            if ($order) {
                $order->update(['trang_thai' => 'Thanh toán thành công']);
                
                // Gửi email hóa đơn
                try {
                    Mail::to($order->email)->send(new OrderInvoiceMail($order));
                    Log::info('Invoice email sent successfully', ['order_id' => $order->id, 'email' => $order->email]);
                } catch (\Exception $e) {
                    Log::error('Failed to send invoice email', [
                        'order_id' => $order->id,
                        'email' => $order->email,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Always set session order info so confirmation shows the correct order
            if ($order) {
                session(['order_id' => $realOrderId, 'order_email' => $order->email]);
            } else {
                session(['order_id' => $realOrderId]);
            }

            // Also pass explicit params to avoid stale session issues
            return redirect()->route('frontend.order.confirmation', [
                'order_id' => $realOrderId,
                'order_email' => $order->email ?? null,
            ])->with('success', 'Thanh toán thành công! Hóa đơn đã được gửi đến email của bạn.');
        } else {
            // Payment failed
            $order = Order::find($realOrderId);
            if ($order) {
                $order->delete();
                OrderDetail::where('order_id', $realOrderId)->delete();
            }

            return redirect()->route('frontend.checkout')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
        }
    }

    public function momoIpn(Request $request)
    {
        $resultCode = $request->get('resultCode');
        $orderId = $request->get('orderId');
        $extraData = $request->get('extraData');

        Log::info('MoMo IPN', $request->all() ?? []);

        // Extract real order ID from extraData
        $realOrderId = $extraData ?: substr($orderId, 0, strlen($orderId) - 4);

        if ($resultCode == 0) {
            $order = Order::find($realOrderId);
            if ($order) {
                $order->update(['trang_thai' => 'Thanh toán thành công']);
                
                // Gửi email hóa đơn (backup - chỉ gửi nếu email chưa được gửi)
                if ($order->email) {
                    try {
                        Mail::to($order->email)->send(new OrderInvoiceMail($order));
                        Log::info('Invoice email sent via IPN', ['order_id' => $order->id, 'email' => $order->email]);
                    } catch (\Exception $e) {
                        Log::error('Failed to send invoice email via IPN', [
                            'order_id' => $order->id,
                            'email' => $order->email,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        
        if ($error) {
            Log::error('MoMo CURL Error', ['error' => $error, 'errno' => $errno]);
        }
        
        curl_close($ch);

        return $result;
    }
}
