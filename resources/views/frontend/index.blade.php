<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trầm Hương Tiên Phước</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="{{('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{('assets/css/icofont/icofont.min.css')}}">
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
                    <!-- <li><a href="./view/carts.php"><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li> -->
                </ul>
            </div>
        </div>
        <div class="header-bottom">
            <div class="logo">
                <a href="{{route('frontend.index')}}">
                    <img src="../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav>
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
                        {{ $user->fullname ?? '' }}
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
        <swiper-container class="mySwiper" pagination="true" pagination-type="progressbar" navigation="true">
            <swiper-slide><img src="../assets/images/b3.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b6.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b5.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b2.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b1.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b4.png"></swiper-slide>
            <swiper-slide><img src="../assets/images/b7.png"></swiper-slide>
        </swiper-container>
        <section class="main-top">
            <h1>TRẦM HƯƠNG TIÊN PHƯỚC</h1>
            <p>Trầm hương Tiên Phước là một trong những loại trầm hương nổi tiếng của Việt Nam, có nguồn gốc từ huyện Tiên Phước, tỉnh Quảng Nam .<br> Đây là một vùng đất có điều kiện tự nhiên thuận lợi cho cây do bầu phát triển, tạo ra trầm hương chất lượng cao.</p>
        </section>
        <section class="container">
            <div class="row">
                <div class="col">
                  <h3>Đặc điểm của Trầm Hương Tiên Phước</h3>
                  <p><i class="icofont-hand-right"></i> Hình thành tự nhiên : Trầm hương Tiên Phước được tạo ra từ cây dó bầu khi bị thâm thương và tích tụ nhựa qua nhiều năm, có mùi thơm đặc trưng.</p>
                  <p><i class="icofont-hand-right"></i> Mùi hương : Trầm hương tại Tiên Phước có hương thơm ngọt ngào, sâu lắng, khi đốt tỏa khói nhẹ nhàng, mùi trầm lưu giữ lâu trong không gian.</p>
                  <p><i class="icofont-hand-right"></i> Chất lượng cao : Trầm hương ở đây được đánh giá là một trong những loại trầm tốt nhất Việt Nam, có giá trị cao trên thị trường.</p>
                </div>
                <div class="col order-5">
                  <h3>Công dụng của Trầm Hương Tiên Phước</h3>
                  <p><i class="icofont-hand-right"></i> Trong phong thủy : Được dùng để xông nhà, trừ tà, thu hút tài lộc và may mắn.</p>
                  <p><i class="icofont-hand-right"></i> Trong y học : Trầm hương có tác dụng an thần, giảm căng thẳng, hỗ trợ sức khỏe.</p>
                  <p><i class="icofont-hand-right"></i> Trong chế độ trang sức : Làm vòng tay, chuỗi hạt phong thủy mang ý nghĩa tâm linh.</p>
                </div>
                <div class="col order-1">
                  <h3>Vì sao Trầm Hương Tiên Phước được ưa chuộng?</h3>
                  <p><i class="icofont-hand-right"></i> Nguồn gốc tự nhiên, chất lượng cao.</p>
                  <p><i class="icofont-hand-right"></i> Mùi hương đặc biệt, khó trộn với nhân tạo.</p>
                  <p><i class="icofont-hand-right"></i> Giá trị phong thủy và sức khỏe cao.</p>
                </div>
            </div>
        </section>
        <section class="section-gt py-5">
            <div class="container text-center">
                <h1>Vì sao bạn nên chọn chúng tôi?</h1>
                <p>Với vai trò là chuyên gia về sản phẩm Trầm hương, chúng tôi nguyện vọng trở thành người bạn của khách hàng...</p>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./assets/images/q1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sức khỏe & Sắc đẹp</h5>
                                <p class="card-text">Trầm hương giúp bảo vệ sức khỏe và duy trì sắc đẹp.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./assets/images/q2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Thu mua tại vườn</h5>
                                <p class="card-text">Trực tiếp tới chủ vườn để thu mua về tận xưởng.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./assets/images/q3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Dòng sản phẩm cao cấp</h5>
                                <p class="card-text">Phân phối dòng sản phẩm Super Negin.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./assets/images/q4.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Uy tín & Chất lượng</h5>
                                <p class="card-text">Uy tín tạo nên thương hiệu cho người dùng yên tâm.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="option-all">
            <div class="selection-opper">
                <h1>SẢN PHẨM TRẦM HƯƠNG TIÊN PHƯỚC</h1>
                <p>Dưới đây là các sản phẩm Trầm Hương được phân phối chính thức bởi Trầm Hương Tiên Phước chính hãng</p>
                <div class="group-product">
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/a6.png" class="cover-img-top" alt="Chuỗi Hạt Trầm Hương 108 Hạt - Malaysia">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Chuỗi Hạt Trầm Hương 108 <br> Hạt - Malaysia</a></h5>
                        <p class="cover-text">Giá: 16.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/a7.png" class="cover-img-top" alt="VÒNG TAY TRẦM HƯƠNG ĐỐT TRÚC BỘC VÀNG 18K">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">VÒNG TAY TRẦM HƯƠNG ĐỐT TRÚC BỘC VÀNG 18K</a></h5>
                        <p class="cover-text">Giá: 26.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/a4.png" class="cover-img-top" alt="Vòng Tay Trầm Hương Nữ 6ly - chìm nước">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Vòng Tay Trầm Hương Nữ 6ly - chìm nước</a></h5>
                        <p class="cover-text">Giá: 21.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/i11.png" class="cover-img-top" alt="Nụ trầm Kiến kim rừng tự nhiên loại đặt biệt">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Nụ trầm Kiến kim rừng tự nhiên loại đặt biệt</a></h5>
                        <p class="cover-text">Giá: 2.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/p1.png" class="cover-img-top" alt="Thác Khói Phật Di Lạc Hồ Lô - Lớn">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Thác Khói Phật Di Lạc<br>Hồ Lô - Lớn</a></h5>
                        <p class="cover-text">Giá: 13.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/p8.png" class="cover-img-top" alt="Thác khói trầm hương Công Decor Hà Nội">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Thác khói trầm hương Công Decor Hà Nội</a></h5>
                        <p class="cover-text">Giá: 17.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/o4.png" class="cover-img-top" alt="Phật Bản Mệnh - PHẬT DI LẶC">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Phật Bản Mệnh: ĐIÊU KHẮC PHẬT DI LẶC</a></h5>
                        <p class="cover-text">Giá: 15.000.000 VNĐ</p>
                        </div>
                    </div>
                    <div class="cover" style="width: 18rem;">
                        <a href="#">
                            <img src="./assets/images/p5.png" class="cover-img-top" alt="Thác Khói Phật Quan Thế Âm - Bồ Tát">
                        </a>
                        <div class="cover-body">
                        <h5 class="cover-title"><a href="#">Thác Khói Phật Quan Thế Âm - Bồ Tát</a></h5>
                        <p class="cover-text">Giá: 16.000.000 VNĐ</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="./assets/images/logo.png">
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</body>
</html>