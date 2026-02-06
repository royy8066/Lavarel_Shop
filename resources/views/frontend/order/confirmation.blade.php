<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="{{('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{('assets/css/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Main Content -->
    <main style="padding: 40px 0; background-color: #f8f9fa; min-height: 100vh;">
        <style>
            /* Footer Styling */
            footer {
                background-color: #97BC62;
                margin-top: 50px;
            }
            footer .footer-top {
                padding: 40px 0;
                background-color: #97BC62;
            }
            footer .footer-top .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 15px;
            }
            footer .footer-top .row {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 40px;
            }
            footer .footer-top .col {
                padding: 0;
            }
            footer .footer-top .col img {
                max-width: 150px;
                margin-bottom: 20px;
                display: block;
            }
            footer .footer-top .col p {
                font-size: 14px;
                color: #fff;
                line-height: 1.8;
                margin-bottom: 10px;
            }
            footer .footer-top .col h3 {
                font-size: 16px;
                font-weight: 700;
                color: #fff;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            footer .footer-top .col a {
                color: #fff;
                text-decoration: none;
                font-size: 14px;
                transition: all 0.3s ease;
                display: inline-block;
                margin-bottom: 10px;
            }
            footer .footer-top .col a:hover {
                color: #fff;
                transform: translateX(5px);
            }
            footer .footer-top .col a i {
                margin-right: 8px;
                width: 16px;
                transition: transform 0.3s ease-in-out;
            }
            footer .footer-top .col a:hover i {
                transform: scale(1.2);
            }
            footer .footer-bottom {
                background-color: #2C5F2D;
                color: white;
                text-align: center;
                padding: 20px 0;
                font-size: 14px;
                font-weight: bold;
            }
            footer .footer-bottom span {
                font-weight: bold;
                color: #ffc107;
            }
            @media (max-width: 768px) {
                footer .footer-top .row {
                    grid-template-columns: 1fr;
                    gap: 30px;
                }
            }
            .bill-container {
                width: 90%;
                max-width: 900px;
                margin: 0 auto;
                background: white;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .bill-header {
                text-align: center;
                margin-bottom: 40px;
                padding-bottom: 30px;
                border-bottom: 2px solid #ddd;
            }
            .bill-logo {
                max-width: 150px;
                margin: 0 auto 20px;
            }
            .bill-logo img {
                width: 100%;
                height: auto;
            }
            .bill-title {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin: 10px 0;
            }
            .bill-subtitle {
                color: #666;
                font-size: 14px;
            }
            .bill-info {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
                margin-bottom: 30px;
            }
            .bill-section {
                font-size: 14px;
            }
            .bill-section-title {
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
                text-transform: uppercase;
                font-size: 12px;
            }
            .bill-section p {
                margin: 5px 0;
                color: #666;
            }
            .bill-items {
                margin-bottom: 30px;
            }
            .bill-items table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }
            .bill-items th {
                background-color: #f5f5f5;
                padding: 10px;
                text-align: left;
                font-weight: bold;
                border-bottom: 2px solid #ddd;
            }
            .bill-items td {
                padding: 10px;
                border-bottom: 1px solid #eee;
            }
            .bill-items img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 4px;
            }
            .bill-total {
                text-align: right;
                margin-bottom: 30px;
                padding-top: 20px;
                border-top: 2px solid #ddd;
            }
            .bill-total-row {
                display: flex;
                justify-content: flex-end;
                margin-bottom: 10px;
                font-size: 16px;
            }
            .bill-total-amount {
                font-weight: bold;
                color: #e74c3c;
                font-size: 24px;
                margin-left: 20px;
            }
            .bill-footer {
                text-align: center;
                padding-top: 20px;
                border-top: 1px solid #ddd;
                color: #999;
                font-size: 12px;
            }
            .btn-back {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                font-size: 14px;
                transition: background-color 0.3s;
            }
            .btn-back:hover {
                background-color: #0056b3;
                color: white;
            }
        </style>

        <div class="bill-container">
            <!-- Header -->
            <div class="bill-header">
                <div class="bill-logo">
                    <img src="../assets/images/logo.png" alt="Logo">
                </div>
                <div class="bill-title">HÓA ĐƠN ĐẶT HÀNG</div>
                <div class="bill-subtitle">Đơn hàng #{{ $order->id }}</div>
            </div>

            <!-- Info -->
            <div class="bill-info">
                <div class="bill-section">
                    <div class="bill-section-title">Thông tin khách hàng</div>
                    <p><strong>{{ $order->fullname }}</strong></p>
                    <p>Email: {{ $order->email }}</p>
                    <p>Điện thoại: {{ $order->sdt }}</p>
                </div>
                <div class="bill-section">
                    <div class="bill-section-title">Địa chỉ giao hàng</div>
                    <p>{{ $order->diachi }}</p>
                    <p>{{ $order->xa_phuong }}, {{ $order->tinh }}</p>
                    <p>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Items -->
            <div class="bill-items">
                <table>
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th style="width: 80px;">Số lượng</th>
                            <th style="width: 100px;">Giá</th>
                            <th style="width: 120px;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $detail)
                            <tr>
                                <td>
                                    @if ($detail->product && $detail->product->img)
                                        <img src="{{ asset('storage/' . $detail->product->img) }}" alt="Ảnh" onerror="this.src='../assets/images/no-image.png'">
                                    @else
                                        <span style="color: #999;">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $detail->ten_sanpham }}</td>
                                <td style="text-align: center;">{{ $detail->soluong }}</td>
                                <td>{{ number_format($detail->giasp) }} VNĐ</td>
                                <td style="text-align: right; font-weight: bold;">{{ number_format($detail->giasp * $detail->soluong) }} VNĐ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total -->
            <div class="bill-total">
                <div class="bill-total-row">
                    <span>Tổng cộng:</span>
                    <span class="bill-total-amount">{{ number_format($order->tongtien) }} VNĐ</span>
                </div>
                <div class="bill-total-row" style="font-size: 14px; color: #666;">
                    <span>Phương thức thanh toán: 
                        @if($order->payment_method == 'cod')
                            Thanh toán khi nhận hàng
                        @elseif($order->payment_method == 'vnpay')
                            Thanh toán online (VNPay)
                        @elseif($order->payment_method == 'momo')
                            Thanh toán online (MoMo)
                        @else
                            {{ $order->payment_method }}
                        @endif
                    </span>
                </div>
            </div>

            <!-- Footer -->
            <div class="bill-footer">
                <p>Cảm ơn bạn đã mua sắm tại Trầm Hương Tiên Phước</p>
                <p>Vui lòng kiểm tra email để xác nhận đơn hàng</p>
            </div>

            <!-- Back Button -->
            <div style="text-align: center;">
                <a href="{{ route('frontend.index') }}" class="btn-back">← Quay lại trang chủ</a>
            </div>
        </div>
    </main>

    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="../assets/images/logo.png">
                        <p>
                            Hiện nay, Trầm Hương Tiên Phước không ngừng<br>
                            cung cấp và cập nhật thêm các sản phẩm giá trị,<br>
                            đồng thời liên tục hoàn thiện chất lượng dịch vụ<br>
                            để hướng tới tầm nhìn trở thành Trung tâm phân<br>
                            phối nhụy hoa nghệ tây - lớn nhất Đông Nam Á.
                        </p>
                    </div>
                    <div class="col order-5">
                        <h3>Theo Dõi Chúng Tôi</h3>
                        <p><a href=""><i class="bi bi-facebook"></i> Facebook</a></p>
                        <p><a href=""><i class="bi bi-youtube"></i> Youtube</a></p>
                        <p><a href=""><i class="bi bi-tiktok"></i>  Tiktok</a></p>
                        <p><a href=""><i class="bi bi-instagram"></i> Instagram</a></p>
                        <p><a href=""><i class="bi bi-telegram"></i> Telegram</a></p>
                    </div>
                    <div class="col order-1">
                        <h3>Hỗ Trợ Khách Hàng</h3>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách mua hàng</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách thanh toán</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách bảo mật thông tin</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách vận chuyển</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách bảo hành</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            @ 2025 <span>Trầm Hương Tiên Phước - Uy Tín - Chất Lượng</span> - Tạo Nên Thương Hiệu
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="../assets/js/javascript.js"></script>
</body>
</html>
