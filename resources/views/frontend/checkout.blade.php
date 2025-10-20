<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/bills.css">
    <link rel="stylesheet" href="../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-top">
            <div class="left">
                <p>Sản phẩm Trầm hương và trang sức Trầm hương</p>
            </div>
            <div class="right">
                <ul>
                    <li><a href="mailto:linhclear@gmail.com"><i class="bi bi-envelope"></i> linhclear@gmail.com</a></li>
                    <li><a href="tel:0337 263 708"><i class="bi bi-telephone"></i> 0337 263 708</a></li>
                    <!-- <li><a href="./carts.php"><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li> -->
                </ul>
            </div>
        </div>
        <div class="header-bottom">
            <div class="logo">
                <a href="{{route('frontend.index')}}">
                    <img src="../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav class="header-line">
                <ul>
                    <li><a href="{{route('frontend.index')}}">Trang chủ</a></li>
                    <li><a href="{{route('frontend.blog')}}">Giới thiệu</a></li>
                    <li><a href="{{ route('frontend.sanpham.product') }}">Sản Phẩm Trầm Hương</a></li>
                    <li><a href="{{ route('frontend.news') }}">Tin tức</a></li>
                    <!-- <li><a href="{{route('frontend.contact')}}">Liên hệ</a></li> -->
                </ul>
            </nav>
            <div class="search">
                <form action="{{ route('frontend.search') }}" method="GET">
                    <input name="keyword" placeholder="Tìm kiếm sản phẩm" type="text" required>
                    <button type="submit" class="btn-search"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="btn-login">
                <div class="icon-carts" data-count="{{ session('cart') ? count(session('cart')) : 0 }}">
                    <a href="{{ route('frontend.cart') }}">
                        <i class="bi bi-cart3" title="Giỏ hàng"></i>
                    </a>
                </div>
                @if(Auth::check())
                    <!-- Nếu đã đăng nhập -->
                    <div class="profile-container position-relative d-inline-block">
                        <img src="{{ asset('assets/images/icons.png') }}" width="40px" id="profile-icon" style="cursor: pointer;">
                        <div class="dropdown-menu" id="profile-menu">
                            <a class="dropdown-item" href="{{route('frontend.profile')}}">Hồ Sơ</a>
                            <a class="dropdown-item" href="#">Cài Đặt</a>
                            <a class="dropdown-item" href="{{route('frontend.lichsu.history')}}">Lịch Sử Mua Hàng</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('frontend.logout') }}">Đăng Xuất</a>
                        </div>
                    </div>
                @else
                    <!-- Nếu chưa đăng nhập -->
                    <a href="{{ route('frontend.login')}}" class="btn p-0 border-0 bg-transparent">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <h1 class="text-center my-4">THANH TOÁN</h1>

        <!-- Hiển thị thông báo lỗi hoặc thành công -->
        @if ($errors->any())
            <div class="alert alert-danger container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger container">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success container">
                {{ session('success') }}
            </div>
        @endif

        <div class="container-bill d-flex flex-wrap gap-5 justify-content-center">
            <div class="form-section w-100" style="max-width: 500px;">
               
                <form class="form-bill" id="checkout-form" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname') }}" required>
                        @error('fullname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số điện thoại</label>
                        <input type="text" name="sdt" id="sdt" class="form-control" value="{{ old('sdt') }}" required pattern="[0-9]{10}">
                        @error('sdt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="diachi" class="form-label">Địa chỉ giao hàng</label>
                        <input type="text" name="diachi" id="diachi" class="form-control" value="{{ old('diachi') }}" required>
                        @error('diachi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @php
                        $total = 0;
                        foreach (session('cart', []) as $item) {
                            $total += $item['giasp'] * $item['quantity'];
                        }
                    @endphp

                    <input type="hidden" name="amount" value="{{ $total }}">
                    <input type="hidden" name="payment_method" id="payment_method" value="">

                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-outline-success w-50" onclick="setPaymentMethod('cod', event)">Thanh toán khi nhận hàng</button>
                        @if($total > 0)
                            <form action="{{ url('vnpay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total }}">
                                <button type="submit" class="btn btn-outline-primary w-50" name="total" onclick="setPaymentMethod('vnpay', event)">Thanh toán online</button>
                            </form>
                        @endif
                    </div>
                </form>
            </div>

            <div class="chitietdh w-100" style="max-width: 700px;">
                <h2 class="mb-3">Chi Tiết Đơn Hàng:</h2>
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Ảnh</th>
                            <th>Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $item)
                                @php
                                    $thanhtien = $item['giasp'] * $item['quantity'];
                                @endphp
                                <tr>
                                    <td>
                                        @if(!empty($item['img']))
                                            <img src="{{ asset('storage/' . $item['img']) }}" width="100" alt="Ảnh sản phẩm">
                                        @else
                                            Không có ảnh
                                        @endif
                                    </td>
                                    <td>{{ $item['ten_sanpham'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ number_format($thanhtien, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">Giỏ hàng trống</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mb-3">
                    <label class="form-label">Tổng tiền:</label>
                    <h4 class="text-danger">{{ number_format($total, 0, ',', '.') }} VNĐ</h4>
                </div>
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
    <script>
        function setPaymentMethod(method, event) {
            event.preventDefault();

            const form = document.getElementById('checkout-form');
            const paymentMethodInput = document.getElementById('payment_method');
            paymentMethodInput.value = method;

            if (method === 'cod') {
                form.action = "{{ route('frontend.checkout') }}";
            } else if (method === 'vnpay') {
                form.action = "{{ route('frontend.vnpay') }}";
            }

            // Hiển thị loading
            const btns = document.querySelectorAll('button[type="submit"]');
            btns.forEach(btn => btn.disabled = true);

            setTimeout(() => form.submit(), 100); // Gửi form sau khi cài đặt payment_method
        }
    </script>
    <script src="../assets/js/javascript.js"></script>
</body>
</html>