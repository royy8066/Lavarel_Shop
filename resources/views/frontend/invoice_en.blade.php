<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
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
        <h1>INVOICE</h1>
        <p><strong>Trầm Hương Tiên Phước</strong></p>
        <p>Email: rimdu12@gmail.com | Phone: 033 850 6457</p>
    </div>

    <div class="info">
        <div class="info-row">
            <span><strong>Invoice No:</strong> #{{ $order->id }}</span>
            <span><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span><strong>Customer:</strong> {{ $order->fullname }}</span>
            <span><strong>Email:</strong> {{ $order->email }}</span>
        </div>
        <div class="info-row">
            <span><strong>Phone:</strong> {{ $order->sdt }}</span>
            <span><strong>Payment:</strong> {{ $order->payment_method }}</span>
        </div>
        <div class="info-row">
            <span><strong>Address:</strong> {{ $order->diachi }}</span>
            <span><strong>Status:</strong> {{ $order->trang_thai }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->ten_sanpham }}</td>
                <td class="text-right">{{ $detail->soluong }}</td>
                <td class="text-right">{{ number_format($detail->giasp, 0, ',', '.') }} VND</td>
                <td class="text-right">{{ number_format($detail->tongtien, 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total:</th>
                <th class="text-right">{{ number_format($order->tongtien, 0, ',', '.') }} VND</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for your purchase at Trầm Hương Tiên Phước!</p>
        <p>Please keep this invoice for your records.</p>
    </div>
</body>
</html>
