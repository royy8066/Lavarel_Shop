<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa đơn #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; }
        .info { margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 11px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>HÓA ĐƠN</h1>
        <p><strong>Trầm Hương Tiên Phước</strong></p>
        <p>Email: rimdu12@gmail.com | Điện thoại: 033 850 6457</p>
    </div>

    <div class="info">
        <div class="info-row">
            <span><strong>Mã hóa đơn:</strong> #{{ $order->id }}</span>
            <span><strong>Ngày:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span><strong>Khách hàng:</strong> {{ $order->fullname }}</span>
            <span><strong>Email:</strong> {{ $order->email }}</span>
        </div>
        <div class="info-row">
            <span><strong>Điện thoại:</strong> {{ $order->sdt }}</span>
            <span><strong>PTTT:</strong> {{ $order->payment_method }}</span>
        </div>
        <div class="info-row">
            <span><strong>Địa chỉ:</strong> {{ $order->diachi }}</span>
            <span><strong>Trạng thái:</strong> {{ $order->trang_thai }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->ten_sanpham }}</td>
                <td class="text-right">{{ $detail->soluong }}</td>
                <td class="text-right">{{ number_format($detail->giasp, 0, ',', '.') }} VNĐ</td>
                <td class="text-right">{{ number_format($detail->tongtien, 0, ',', '.') }} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Tổng cộng:</th>
                <th class="text-right">{{ number_format($order->tongtien, 0, ',', '.') }} VNĐ</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Cảm ơn quý khách đã mua hàng tại Trầm Hương Tiên Phước!</p>
        <p>Để tra cứu tình trạng đơn hàng, vui lòng giữ lại hóa đơn này.</p>
    </div>
</body>
</html>
