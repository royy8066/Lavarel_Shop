<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn thanh toán #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1ab394;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #1ab394;
            margin-bottom: 10px;
        }
        .invoice-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .invoice-info h2 {
            color: #1ab394;
            margin-top: 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-section h3 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .info-item strong {
            color: #555;
            display: inline-block;
            width: 100px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1ab394;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-row {
            font-size: 18px;
            font-weight: bold;
            color: #1ab394;
            margin-bottom: 10px;
        }
        .payment-info {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
            margin-bottom: 30px;
        }
        .payment-info h3 {
            color: #28a745;
            margin-top: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }
        .status-success {
            color: #28a745;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">TRẦM HƯƠNG TIÊN PHƯỚC</div>
            <h1>HÓA ĐƠN THANH TOÁN</h1>
            <p>Mã đơn hàng: #{{ $order->id }}</p>
        </div>

        <div class="invoice-info">
            <h2>Thông tin hóa đơn</h2>
            <div class="info-item">
                <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="info-item">
                <strong>Phương thức:</strong> {{ $order->payment_method == 'momo' ? 'Ví MoMo' : 'Thanh toán khi nhận hàng' }}
            </div>
            <div class="info-item">
                <strong>Trạng thái:</strong> <span class="status-success">{{ $order->trang_thai }}</span>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>Thông tin khách hàng</h3>
                <div class="info-item">
                    <strong>Họ tên:</strong> {{ $order->fullname }}
                </div>
                <div class="info-item">
                    <strong>Email:</strong> {{ $order->email }}
                </div>
                <div class="info-item">
                    <strong>Điện thoại:</strong> {{ $order->sdt }}
                </div>
            </div>
            <div class="info-section">
                <h3>Địa chỉ giao hàng</h3>
                <div class="info-item">
                    <strong>Địa chỉ:</strong> {{ $order->diachi }}
                </div>
                <div class="info-item">
                    <strong>Tỉnh/TP:</strong> {{ $order->tinh }}
                </div>
                <div class="info-item">
                    <strong>Xã/Phường:</strong> {{ $order->xa_phuong }}
                </div>
            </div>
        </div>

        <h3>Chi tiết đơn hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->ten_sanpham }}</td>
                    <td>{{ $detail->soluong }}</td>
                    <td>{{ number_format($detail->giasp, 0, ',', '.') }} đ</td>
                    <td>{{ number_format($detail->tongtien, 0, ',', '.') }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                Tổng cộng: {{ number_format($order->tongtien, 0, ',', '.') }} đ
            </div>
        </div>

        <div class="payment-info">
            <h3>✅ Thanh toán thành công!</h3>
            <p>Đơn hàng của bạn đã được thanh toán thành công qua Ví MoMo. Chúng tôi sẽ xác nhận đơn hàng và bắt đầu quá trình đóng gói.</p>
            <p>Thời gian giao hàng dự kiến: 2-4 ngày làm việc.</p>
        </div>

        <div class="footer">
            <p><strong>Trầm Hương Tiên Phước</strong></p>
            <p>📞 Hotline: 1900-xxxx | 📧 Email: info@tramhuongtienphuoc.com</p>
            <p>🌐 Website: www.tramhuongtienphuoc.com</p>
            <p>Cảm ơn bạn đã tin tưởng và mua hàng tại cửa hàng chúng tôi!</p>
        </div>
    </div>
</body>
</html>
