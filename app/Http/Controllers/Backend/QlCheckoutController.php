<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class QlCheckoutController extends Controller
{
    public function qldh(Request $request){
        $tab = $request->get('tab', 'all');
        
        $query = Order::orderBy('created_at', 'desc');
        
        if ($tab === 'guest') {
            $query->whereNull('user_id');
            $title = 'Đơn hàng khách vãng lai';
        } elseif ($tab === 'customer') {
            $query->whereNotNull('user_id');
            $title = 'Đơn hàng khách đăng nhập';
        } else {
            $title = 'Tất cả đơn hàng';
        }
        
        $orders = $query->paginate(10);
        
        if ($request->ajax()) {
            $html = view('backend.donhang.partials.orders_table', compact('orders'))->render();
            return response()->json(['html' => $html]);
        }
        
        return view('backend.donhang.qldh', compact('orders', 'tab', 'title'));
    }

    public function showdh($id){
        $order = Order::with('orderDetails.product')->findOrFail($id);
        return view('backend.donhang.showdh', compact('order'));
    }

    public function delete($id){
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('backend.donhang.qldh')->with('success', 'Xóa đơn hàng thành công.');
    }

    public function duyetdh($id){
        $order = Order::findOrFail($id);

        if ($order->trang_thai === 'Chờ xác nhận') {
            $order->trang_thai = 'Đơn hàng đã được gửi đi';
            $order->save();

            return redirect()->back()->with('success', 'Đơn hàng đã được duyệt.');
        }

        return redirect()->back()->with('error', 'Đơn hàng không hợp lệ hoặc đã được duyệt.');
    }

}
