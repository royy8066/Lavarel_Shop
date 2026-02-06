<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tin Tức</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/news.css">
    <link rel="stylesheet" href="../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <div class="container">
            <header class="top">
                <h1>Tin Tức</h1>
            </header>
            <div class="main-right">
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('frontend.tintuc.news1') }}"><img src="../assets/images/t1.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="{{ route('frontend.tintuc.news1') }}">Tác dụng Trầm Hương trong lối sống người Việt</a></h5>
                      <p class="card-text"><a href="{{ route('frontend.tintuc.news1') }}">Trầm Hương từ lâu đã đi sâu vào cuộc sống của người Việt Nam vì ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('frontend.tintuc.news1') }}"><img src="../assets/images/t2.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="{{ route('frontend.tintuc.news1') }}">Trầm Hương là gì và cách nhận biết trầm hương</a></h5>
                      <p class="card-text"><a href="{{ route('frontend.tintuc.news1') }}">1. Trầm hương là gì ? Trầm hương (沉香, Agarwood), là tên gọi chung cho ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('frontend.tintuc.news1') }}"><img src="../assets/images/t3.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="{{ route('frontend.tintuc.news1') }}">5 sản phẩm phổ biến được làm từ gỗ Trầm Hương</a></h5>
                      <p class="card-text"><a href="{{ route('frontend.tintuc.news1') }}">Gỗ Trầm Hương là loại gỗ đặc biệt nhất trong dân gian. Nó đem lại ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('frontend.tintuc.news1') }}"><img src="../assets/images/t4.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="{{ route('frontend.tintuc.news1') }}">8 Mẹo phong thủy nhà ở hút tiền tài luôn được nhà giàu áp dụng</a></h5>
                      <p class="card-text"><a href="{{ route('frontend.tintuc.news1') }}">Không chỉ giỏi kiếm tiền, người giàu còn biết vận dụng những mẹo phong thủy ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('frontend.tintuc.news1') }}"><img src="../assets/images/t5.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="{{ route('frontend.tintuc.news1') }}">Nhang trầm hương nụ - tác dụng và cách thưởng thức trọn vẹn</a></h5>
                      <p class="card-text"><a href="{{ route('frontend.tintuc.news1') }}">Chúng ta vẫn thường biết đến Trầm Hương thông qua một số sản phẩm như ...</a></p>
                    </div>
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
    <script src="../assets/js/javascript.js"></script>
</body>
</html>