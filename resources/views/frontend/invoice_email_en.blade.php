<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order at Trầm Hương Tiên Phước!</h2>

    <p>Hello <strong>{{ $order->fullname }}</strong>,</p>
    <p>Your order #{{ $order->id }} has been successfully received.</p>

    <h3>Order Information:</h3>
    <ul>
        <li><strong>Order Number:</strong> #{{ $order->id }}</li>
        <li><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
        <li><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
        <li><strong>Total Amount:</strong> {{ number_format($order->tongtien, 0, ',', '.') }} VND</li>
        <li><strong>Status:</strong> {{ $order->trang_thai }}</li>
    </ul>

    <h3>Shipping Address:</h3>
    <p>{{ $order->diachi }}</p>

    <p>We will confirm and ship your order soon. You can track your order status in your purchase history on our website.</p>

    <p>The detailed invoice is attached to this email.</p>

    <p>Best regards,<br><strong>Trầm Hương Tiên Phước</strong><br>Email: rimdu12@gmail.com | Phone: 033 850 6457</p>
</body>
</html>
