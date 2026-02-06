<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hello</title>
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
                    <li><a href="mailto:linhclear@gmail.com"><i class="bi bi-envelope"></i>rimdu12@gmail.com</a></li>
                    <li><a href="tel:033 850 6457"><i class="bi bi-telephone"></i> 033 850 6457</a></li>
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
        <h1 class="text-center my-4">Hello</h1>

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
                        <label class="form-label">Language / Ngôn ngữ</label>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="locale" id="locale_vi" value="vi" {{ session('locale', 'vi') == 'vi' ? 'checked' : '' }} autocomplete="off">
                            <label class="btn btn-outline-primary" for="locale_vi">Tiếng Việt</label>
                            
                            <input type="radio" class="btn-check" name="locale" id="locale_en" value="en" {{ session('locale') == 'en' ? 'checked' : '' }} autocomplete="off">
                            <label class="btn btn-outline-primary" for="locale_en">English</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            <button class="btn btn-outline-secondary" type="button" id="sendOtpBtn">Gửi OTP</button>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3" id="otpSection" style="display: none;">
                        <label for="otp" class="form-label">Mã OTP</label>
                        <div class="input-group">
                            <input type="text" name="otp" id="otp" class="form-control text-center" placeholder="Nhập mã OTP 6 chữ số" maxlength="6" style="letter-spacing: 4px; font-weight: bold; font-size: 1.2rem;">
                            <button class="btn btn-sm btn-success" type="button" id="verifyOtpBtn">Xác thực</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">Mã có hiệu lực trong <span id="otpCountdown" class="fw-bold text-danger">5:00</span></small>
                            <button class="btn btn-sm btn-outline-secondary" type="button" id="resendOtpBtn" disabled>Gửi lại</button>
                        </div>
                        <div id="otpStatus" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số điện thoại</label>
                        <input type="text" name="sdt" id="sdt" class="form-control" value="{{ old('sdt') }}" required pattern="[0-9]{10}" maxlength="10">
                        @error('sdt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tinh" class="form-label">Tỉnh/Thành phố</label>
                        <select name="tinh" id="tinh" class="form-control" required onchange="updateQuanHuyen()">
                            <option value="">-- Chọn Tỉnh/Thành phố --</option>
                            <option value="Đà Nẵng" {{ old('tinh') == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                            <option value="Hà Nội" {{ old('tinh') == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                            <option value="TP. Hồ Chí Minh" {{ old('tinh') == 'TP. Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                            <option value="Hải Phòng" {{ old('tinh') == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                            <option value="Cần Thơ" {{ old('tinh') == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
                            <option value="Quảng Ninh" {{ old('tinh') == 'Quảng Ninh' ? 'selected' : '' }}>Quảng Ninh</option>
                            <option value="Bắc Ninh" {{ old('tinh') == 'Bắc Ninh' ? 'selected' : '' }}>Bắc Ninh</option>
                            <option value="Hải Dương" {{ old('tinh') == 'Hải Dương' ? 'selected' : '' }}>Hải Dương</option>
                            <option value="Hưng Yên" {{ old('tinh') == 'Hưng Yên' ? 'selected' : '' }}>Hưng Yên</option>
                            <option value="Thái Bình" {{ old('tinh') == 'Thái Bình' ? 'selected' : '' }}>Thái Bình</option>
                            <option value="Thái Nguyên" {{ old('tinh') == 'Thái Nguyên' ? 'selected' : '' }}>Thái Nguyên</option>
                            <option value="Lạng Sơn" {{ old('tinh') == 'Lạng Sơn' ? 'selected' : '' }}>Lạng Sơn</option>
                            <option value="Tuyên Quang" {{ old('tinh') == 'Tuyên Quang' ? 'selected' : '' }}>Tuyên Quang</option>
                            <option value="Yên Bái" {{ old('tinh') == 'Yên Bái' ? 'selected' : '' }}>Yên Bái</option>
                            <option value="Sơn La" {{ old('tinh') == 'Sơn La' ? 'selected' : '' }}>Sơn La</option>
                            <option value="Hòa Bình" {{ old('tinh') == 'Hòa Bình' ? 'selected' : '' }}>Hòa Bình</option>
                            <option value="Ninh Bình" {{ old('tinh') == 'Ninh Bình' ? 'selected' : '' }}>Ninh Bình</option>
                            <option value="Thanh Hóa" {{ old('tinh') == 'Thanh Hóa' ? 'selected' : '' }}>Thanh Hóa</option>
                            <option value="Nghệ An" {{ old('tinh') == 'Nghệ An' ? 'selected' : '' }}>Nghệ An</option>
                            <option value="Hà Tĩnh" {{ old('tinh') == 'Hà Tĩnh' ? 'selected' : '' }}>Hà Tĩnh</option>
                            <option value="Quảng Bình" {{ old('tinh') == 'Quảng Bình' ? 'selected' : '' }}>Quảng Bình</option>
                            <option value="Quảng Trị" {{ old('tinh') == 'Quảng Trị' ? 'selected' : '' }}>Quảng Trị</option>
                            <option value="Thừa Thiên Huế" {{ old('tinh') == 'Thừa Thiên Huế' ? 'selected' : '' }}>Thừa Thiên Huế</option>
                            <option value="Quảng Nam" {{ old('tinh') == 'Quảng Nam' ? 'selected' : '' }}>Quảng Nam</option>
                            <option value="Quảng Ngãi" {{ old('tinh') == 'Quảng Ngãi' ? 'selected' : '' }}>Quảng Ngãi</option>
                            <option value="Bình Định" {{ old('tinh') == 'Bình Định' ? 'selected' : '' }}>Bình Định</option>
                            <option value="Phú Yên" {{ old('tinh') == 'Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
                            <option value="Khánh Hòa" {{ old('tinh') == 'Khánh Hòa' ? 'selected' : '' }}>Khánh Hòa</option>
                            <option value="Ninh Thuận" {{ old('tinh') == 'Ninh Thuận' ? 'selected' : '' }}>Ninh Thuận</option>
                            <option value="Bình Thuận" {{ old('tinh') == 'Bình Thuận' ? 'selected' : '' }}>Bình Thuận</option>
                            <option value="Đắk Lắk" {{ old('tinh') == 'Đắk Lắk' ? 'selected' : '' }}>Đắk Lắk</option>
                            <option value="Đắk Nông" {{ old('tinh') == 'Đắk Nông' ? 'selected' : '' }}>Đắk Nông</option>
                            <option value="Gia Lai" {{ old('tinh') == 'Gia Lai' ? 'selected' : '' }}>Gia Lai</option>
                            <option value="Kon Tum" {{ old('tinh') == 'Kon Tum' ? 'selected' : '' }}>Kon Tum</option>
                            <option value="Lâm Đồng" {{ old('tinh') == 'Lâm Đồng' ? 'selected' : '' }}>Lâm Đồng</option>
                            <option value="Bình Phước" {{ old('tinh') == 'Bình Phước' ? 'selected' : '' }}>Bình Phước</option>
                            <option value="Tây Ninh" {{ old('tinh') == 'Tây Ninh' ? 'selected' : '' }}>Tây Ninh</option>
                            <option value="Bình Dương" {{ old('tinh') == 'Bình Dương' ? 'selected' : '' }}>Bình Dương</option>
                            <option value="Đồng Nai" {{ old('tinh') == 'Đồng Nai' ? 'selected' : '' }}>Đồng Nai</option>
                            <option value="Bà Rịa - Vũng Tàu" {{ old('tinh') == 'Bà Rịa - Vũng Tàu' ? 'selected' : '' }}>Bà Rịa - Vũng Tàu</option>
                            <option value="Long An" {{ old('tinh') == 'Long An' ? 'selected' : '' }}>Long An</option>
                            <option value="Tiền Giang" {{ old('tinh') == 'Tiền Giang' ? 'selected' : '' }}>Tiền Giang</option>
                            <option value="Bến Tre" {{ old('tinh') == 'Bến Tre' ? 'selected' : '' }}>Bến Tre</option>
                            <option value="Trà Vinh" {{ old('tinh') == 'Trà Vinh' ? 'selected' : '' }}>Trà Vinh</option>
                            <option value="Vĩnh Long" {{ old('tinh') == 'Vĩnh Long' ? 'selected' : '' }}>Vĩnh Long</option>
                            <option value="Đồng Tháp" {{ old('tinh') == 'Đồng Tháp' ? 'selected' : '' }}>Đồng Tháp</option>
                            <option value="An Giang" {{ old('tinh') == 'An Giang' ? 'selected' : '' }}>An Giang</option>
                            <option value="Kiên Giang" {{ old('tinh') == 'Kiên Giang' ? 'selected' : '' }}>Kiên Giang</option>
                            <option value="Hậu Giang" {{ old('tinh') == 'Hậu Giang' ? 'selected' : '' }}>Hậu Giang</option>
                            <option value="Sóc Trăng" {{ old('tinh') == 'Sóc Trăng' ? 'selected' : '' }}>Sóc Trăng</option>
                            <option value="Bạc Liêu" {{ old('tinh') == 'Bạc Liêu' ? 'selected' : '' }}>Bạc Liêu</option>
                            <option value="Cà Mau" {{ old('tinh') == 'Cà Mau' ? 'selected' : '' }}>Cà Mau</option>
                        </select>
                        @error('tinh')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quan_huyen" class="form-label">Quận/Huyện</label>
                        <select name="quan_huyen" id="quan_huyen" class="form-control" required onchange="updateXaPhuong()">
                            <option value="">-- Chọn Quận/Huyện --</option>
                        </select>
                        @error('quan_huyen')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="xa_phuong" class="form-label">Xã/Phường</label>
                        <select name="xa_phuong" id="xa_phuong" class="form-control" required onchange="updateDiaChi()">
                            <option value="">-- Chọn Xã/Phường --</option>
                        </select>
                        @error('xa_phuong')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi_chi_tiet" class="form-label">Địa chỉ giao hàng (Số nhà, tên đường, ngõ ngách...)</label>
                        <input type="text" name="dia_chi_chi_tiet" id="dia_chi_chi_tiet" class="form-control" value="{{ old('dia_chi_chi_tiet') }}" required onchange="updateDiaChi()" oninput="updateDiaChi()">
                        @error('dia_chi_chi_tiet')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="diachi" id="diachi" value="{{ old('diachi') }}">

                    @php
                        $total = 0;
                        foreach (session('cart', []) as $item) {
                            $total += $item['giasp'] * $item['quantity'];
                        }
                    @endphp

                    <input type="hidden" name="amount" value="{{ $total }}">
                    <input type="hidden" name="payment_method" id="payment_method" value="">
                    <input type="hidden" name="otp_verified" id="otp_verified" value="0">

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                            <label class="form-check-label" for="agreeTerms">
                                Tôi đồng ý với <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" style="color: #007bff; text-decoration: underline;">điều khoản và điều kiện</a> của cửa hàng
                            </label>
                        </div>
                        @error('agree_terms')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-outline-success flex-fill" id="codBtn" onclick="setPaymentMethod('cod', event)">Thanh toán khi nhận hàng</button>
                        @if($total > 0)
                            <button type="submit" class="btn btn-outline-primary flex-fill" id="vnpayBtn" onclick="setPaymentMethod('vnpay', event)">Thanh toán VNPay</button>
                            <button type="submit" class="btn btn-outline-danger flex-fill" id="momoBtn" onclick="setPaymentMethod('momo', event)">Thanh toán MoMo</button>
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
        // Dữ liệu quận/huyện theo tỉnh/thành phố
        const districtData = {
            'Đà Nẵng': ['Quận Hải Châu', 'Quận Thanh Khê', 'Quận Sơn Trà', 'Quận Ngũ Hành Sơn', 'Quận Liên Chiểu', 'Quận Cẩm Lệ', 'Huyện Hòa Vang', 'Huyện Hoàng Sa'],
            'Hà Nội': ['Quận Ba Đình', 'Quận Hoàn Kiếm', 'Quận Tây Hồ', 'Quận Long Biên', 'Quận Cầu Giấy', 'Quận Đống Đa', 'Quận Hai Bà Trưng', 'Quận Hoàng Mai', 'Quận Thanh Xuân', 'Huyện Sóc Sơn', 'Huyện Đông Anh', 'Huyện Gia Lâm', 'Huyện Thanh Trì', 'Huyện Mê Linh', 'Huyện Đan Phượng', 'Huyện Hoài Đức', 'Huyện Quốc Oai', 'Huyện Thạch Thất', 'Huyện Chương Mỹ', 'Huyện Thanh Oai', 'Huyện Thường Tín', 'Huyện Phú Xuyên', 'Huyện Ứng Hòa', 'Huyện Mỹ Đức'],
            'TP. Hồ Chí Minh': ['Quận 1', 'Quận 2', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 9', 'Quận 10', 'Quận 11', 'Quận 12', 'Quận Bình Tân', 'Quận Bình Thạnh', 'Quận Gò Vấp', 'Quận Phú Nhuận', 'Quận Tân Bình', 'Quận Tân Phú', 'Quận Thủ Đức', 'Huyện Bình Chánh', 'Huyện Cần Giờ', 'Huyện Củ Chi', 'Huyện Hóc Môn', 'Huyện Nhà Bè'],
            'Hải Phòng': ['Quận Hồng Bàng', 'Quận Ngô Quyền', 'Quận Lê Chân', 'Quận Kiến An', 'Quận Hải An', 'Quận Đồ Sơn', 'Quận Dương Kinh', 'Huyện An Dương', 'Huyện An Lão', 'Huyện Bạch Long Vĩ', 'Huyện Cát Hải', 'Huyện Kiến Thụy', 'Huyện Thủy Nguyên', 'Huyện Tiên Lãng', 'Huyện Vĩnh Bảo'],
            'Cần Thơ': ['Quận Ninh Kiều', 'Quận Bình Thủy', 'Quận Cái Răng', 'Quận Ô Môn', 'Quận Thốt Nốt', 'Huyện Phong Điền', 'Huyện Cờ Đỏ', 'Huyện Thái Lai', 'Huyện Vĩnh Thạnh']
        };
        
        // Dữ liệu xã/phường theo quận/huyện
        const wardData = {
            // Đà Nẵng
            'Quận Hải Châu': ['Phường Bình Hiên', 'Phường Bình Thuận', 'Phường Hải Châu I', 'Phường Hải Châu II', 'Phường Hòa Cường Bắc', 'Phường Hòa Cường Nam', 'Phường Hòa Thuận Đông', 'Phường Hòa Thuận Tây', 'Phường Nam Dương', 'Phường Phước Ninh', 'Phường Thạch Thang', 'Phường Thanh Bình', 'Phường Thuận Phước'],
            'Quận Thanh Khê': ['Phường An Khê', 'Phường Chính Giáp', 'Phường Hòa Khê', 'Phường Tam Thuận', 'Phường Tân Chính', 'Phường Thạc Giáp', 'Phường Thanh Khê Đông', 'Phường Thanh Khê Tây', 'Phường Vĩnh Trung', 'Phường Xuân Hà'],
            'Quận Sơn Trà': ['Phường An Hải Bắc', 'Phường An Hải Đông', 'Phường An Hải Tây', 'Phường Mân Thái', 'Phường Nạn Hiên Đông', 'Phường Phước Mỹ', 'Phường Thọ Quang', 'Phường An Hải', 'Phường Phước Ninh'],
            
            // TP. Hồ Chí Minh
            'Quận 1': ['Phường Bến Nghé', 'Phường Bến Thành', 'Phường Cô Giang', 'Phường Đa Kao', 'Phường Nguyễn Huệ', 'Phường Tân Định'],
            'Quận 2': ['Phường An Khánh', 'Phường An Lợi Đông', 'Phường Bình An', 'Phường Bình Khánh', 'Phường Cát Lái', 'Phường Thạnh Mỹ Lợi', 'Phường Thảo Điền'],
            'Quận 3': ['Phường 1', 'Phường 2', 'Phường 3', 'Phường 4', 'Phường 5', 'Phường 6', 'Phường 7', 'Phường 8', 'Phường 9', 'Phường 10', 'Phường 11', 'Phường 12', 'Phường 13', 'Phường 14'],
            
            // Hà Nội
            'Quận Ba Đình': ['Phường Điện Biên', 'Phường Đội Cấn', 'Phường Giảng Võ', 'Phường Kim Mã', 'Phường Liễu Giai', 'Phường Ngọc Hà', 'Phường Ngọc Khánh', 'Phường Nguyễn Trung Trực', 'Phường Phúc Xá', 'Phường Quán Thánh', 'Phường Thành Công', 'Phường Trúc Bạch', 'Phường Trung Liệt', 'Phường Vĩnh Phúc'],
            'Quận Hoàn Kiếm': ['Phường Chương Dương', 'Phường Cửa Đông', 'Phường Cửa Nam', 'Phường Đồng Xuân', 'Phường Hàng Bạc', 'Phường Hàng Bài', 'Phường Hàng Bồ', 'Phường Hàng Bông', 'Phường Hàng Buồm', 'Phường Hàng Đào', 'Phường Hàng Gai', 'Phường Hàng Mã', 'Phường Hàng Trống', 'Phường Lý Thái Tổ', 'Phường Phan Chu Trinh', 'Phường Phúc Tân', 'Phường Trần Hưng Đạo', 'Phường Tràng Tiền']
        };

        function updateQuanHuyen() {
            const tinhSelect = document.getElementById('tinh');
            const quanHuyenSelect = document.getElementById('quan_huyen');
            const selectedTinh = tinhSelect.value;

            // Xóa tất cả option cũ
            quanHuyenSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';

            // Reset xã/phường
            const xaPhuongSelect = document.getElementById('xa_phuong');
            xaPhuongSelect.innerHTML = '<option value="">-- Chọn Xã/Phường --</option>';

            // Thêm option mới dựa trên tỉnh được chọn
            if (selectedTinh && districtData[selectedTinh]) {
                districtData[selectedTinh].forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    quanHuyenSelect.appendChild(option);
                });
            }
            
            updateDiaChi();
        }

        function updateXaPhuong() {
            const quanHuyenSelect = document.getElementById('quan_huyen');
            const xaPhuongSelect = document.getElementById('xa_phuong');
            const selectedQuanHuyen = quanHuyenSelect.value;

            // Xóa tất cả option cũ
            xaPhuongSelect.innerHTML = '<option value="">-- Chọn Xã/Phường --</option>';

            // Thêm option mới dựa trên quận/huyện được chọn
            if (selectedQuanHuyen && wardData[selectedQuanHuyen]) {
                wardData[selectedQuanHuyen].forEach(ward => {
                    const option = document.createElement('option');
                    option.value = ward;
                    option.textContent = ward;
                    xaPhuongSelect.appendChild(option);
                });
            }
            
            updateDiaChi();
        }

        // Gọi hàm cập nhật quận/huyện và xã/phường khi tải trang
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo dữ liệu địa chỉ nếu có giá trị cũ từ session
            @if(old('tinh'))
                updateQuanHuyen();
                // Đặt lại giá trị quận/huyện nếu có
                @if(old('quan_huyen'))
                    setTimeout(() => {
                        document.getElementById('quan_huyen').value = '{{ old('quan_huyen') }}';
                        updateXaPhuong();
                        // Đặt lại giá trị xã/phường nếu có
                        @if(old('xa_phuong'))
                            setTimeout(() => {
                                document.getElementById('xa_phuong').value = '{{ old('xa_phuong') }}';
                                updateDiaChi();
                            }, 100);
                        @endif
                    }, 100);
                @endif
            @endif
            
            // Cập nhật địa chỉ khi form được submit
            document.getElementById('checkout-form').addEventListener('submit', function() {
                updateDiaChi();
            });
        });

        function updateDiaChi() {
            const tinh = document.getElementById('tinh').value;
            const quanHuyen = document.getElementById('quan_huyen').value;
            const xaPhuong = document.getElementById('xa_phuong').value;
            const diaChiChiTiet = document.getElementById('dia_chi_chi_tiet').value;

            const diachi = `${tinh}, ${quanHuyen}, ${xaPhuong}, ${diaChiChiTiet}`;
            document.getElementById('diachi').value = diachi;
        }

        // Language selection
        document.querySelectorAll('input[name="locale"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const locale = this.value;
                // Save to session via AJAX
                fetch('{{ route("locale.set") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ locale: locale })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Language set to: ' + locale);
                        // Optionally reload page to update UI
                        // window.location.reload();
                    }
                })
                .catch(error => console.error('Error setting language:', error));
            });
        });

        // OTP Functions
        let otpCountdownInterval;

        function startOtpCountdown() {
            let seconds = 300; // 5 minutes
            const countdownEl = document.getElementById('otpCountdown');
            const resendBtn = document.getElementById('resendOtpBtn');

            clearInterval(otpCountdownInterval);
            otpCountdownInterval = setInterval(() => {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                countdownEl.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
                seconds--;

                if (seconds < 0) {
                    clearInterval(otpCountdownInterval);
                    countdownEl.textContent = 'Hết hạn';
                    countdownEl.classList.remove('text-danger');
                    countdownEl.classList.add('text-muted');
                    resendBtn.disabled = false;
                }
            }, 1000);
        }

        function sendOtp(email, isResend = false) {
            fetch('{{ route("otp.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('otpSection').style.display = 'block';
                    document.getElementById('otp').value = '';
                    document.getElementById('otp').focus();
                    document.getElementById('otpStatus').innerHTML = '';
                    startOtpCountdown();
                    if (isResend) {
                        document.getElementById('resendOtpBtn').disabled = true;
                        document.getElementById('otpCountdown').classList.remove('text-muted');
                        document.getElementById('otpCountdown').classList.add('text-danger');
                    }
                    alert(data.message);
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            });
        }

        document.getElementById('sendOtpBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            if (!email) {
                alert('Vui lòng nhập email');
                return;
            }
            sendOtp(email);
        });

        document.getElementById('resendOtpBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            if (!email) {
                alert('Vui lòng nhập email');
                return;
            }
            sendOtp(email, true);
        });

        document.getElementById('verifyOtpBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;

            if (!otp || otp.length !== 6) {
                document.getElementById('otpStatus').innerHTML = '<span class="text-danger">Vui lòng nhập đủ 6 chữ số</span>';
                return;
            }

            fetch('{{ route("otp.verify") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: email, otp: otp })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('otp_verified').value = '1';
                    document.getElementById('otpStatus').innerHTML = '<span class="badge bg-success">✓ Xác thực thành công</span>';
                    clearInterval(otpCountdownInterval);
                    document.getElementById('otpCountdown').textContent = 'Đã xác thực';
                    document.getElementById('otpCountdown').classList.remove('text-danger');
                    document.getElementById('otpCountdown').classList.add('text-success');
                    document.getElementById('resendOtpBtn').disabled = true;
                    alert(data.message);
                } else {
                    document.getElementById('otpStatus').innerHTML = '<span class="text-danger">' + data.message + '</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('otpStatus').innerHTML = '<span class="text-danger">Có lỗi xảy ra, vui lòng thử lại.</span>';
            });
        });

        function setPaymentMethod(method, event) {
            event.preventDefault();

            const agreeTerms = document.getElementById('agreeTerms').checked;
            if (!agreeTerms) {
                alert('Vui lòng đồng ý với điều khoản và điều kiện trước khi thanh toán');
                return;
            }

            const otpVerified = document.getElementById('otp_verified').value;
            if (otpVerified !== '1') {
                alert('Vui lòng xác thực OTP trước khi thanh toán');
                return;
            }

            const form = document.getElementById('checkout-form');
            const paymentMethodInput = document.getElementById('payment_method');
            paymentMethodInput.value = method;

            if (method === 'cod') {
                form.action = "{{ route('frontend.checkout') }}";
            } else if (method === 'vnpay') {
                form.action = "{{ route('frontend.vnpay') }}";
            } else if (method === 'momo') {
                form.action = "{{ route('frontend.momo') }}";
            }

            // Hiển thị loading
            const btns = document.querySelectorAll('button[type="submit"]');
            btns.forEach(btn => btn.disabled = true);

            setTimeout(() => form.submit(), 100); // Gửi form sau khi cài đặt payment_method
        }
    </script>

    <!-- Modal Điều khoản và điều kiện -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Điều khoản và Điều kiện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <h6><strong>1. Chính sách mua hàng</strong></h6>
                    <p>Khách hàng có quyền mua hàng trực tuyến hoặc trực tiếp tại cửa hàng. Tất cả các sản phẩm được bán đều có chất lượng đảm bảo.</p>

                    <h6><strong>2. Chính sách thanh toán</strong></h6>
                    <p>Cửa hàng chấp nhận các hình thức thanh toán sau:</p>
                    <ul>
                        <li>Thanh toán khi nhận hàng (COD)</li>
                        <li>Thanh toán trực tuyến qua VNPay</li>
                        <li>Thanh toán trực tuyến qua MoMo</li>
                    </ul>

                    <h6><strong>3. Chính sách bảo mật thông tin</strong></h6>
                    <p>Cửa hàng cam kết bảo vệ thông tin cá nhân của khách hàng. Tất cả thông tin sẽ được mã hóa và lưu trữ an toàn.</p>

                    <h6><strong>4. Chính sách vận chuyển</strong></h6>
                    <p>Sản phẩm sẽ được giao đến địa chỉ của khách hàng trong vòng 3-5 ngày làm việc. Phí vận chuyển sẽ được tính dựa trên khoảng cách.</p>

                    <h6><strong>5. Chính sách bảo hành</strong></h6>
                    <p>Tất cả sản phẩm được bảo hành trong vòng 30 ngày kể từ ngày mua. Nếu sản phẩm bị lỗi, khách hàng có thể yêu cầu hoàn tiền hoặc đổi sản phẩm.</p>

                    <h6><strong>6. Quyền và trách nhiệm của khách hàng</strong></h6>
                    <p>Khách hàng cam kết cung cấp thông tin chính xác khi đặt hàng. Khách hàng chịu trách nhiệm về tính chính xác của thông tin cung cấp.</p>

                    <h6><strong>7. Quyền và trách nhiệm của cửa hàng</strong></h6>
                    <p>Cửa hàng cam kết cung cấp sản phẩm chất lượng cao và dịch vụ khách hàng tốt. Cửa hàng có quyền từ chối đơn hàng nếu có dấu hiệu gian lận.</p>

                    <h6><strong>8. Điều khoản chung</strong></h6>
                    <p>Bằng cách sử dụng dịch vụ của cửa hàng, khách hàng đồng ý tuân thủ tất cả các điều khoản và điều kiện được nêu trong tài liệu này.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/javascript.js"></script>
</body>
</html>