<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/productdetail.css">
    <link rel="stylesheet" href="../assets/css/product-zoom.css">
    <link rel="stylesheet" href="../assets/css/comments.css">
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
                    <!-- <li><a href="{{ route('frontend.cart') }}"><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li> -->
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
        <div class="container mt-5">
            <h1 class="text-center mb-4">Chi Tiết Sản Phẩm</h1>
            <div class="main-list">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="main-image product-image-zoom">
                            <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->ten_sanpham }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('frontend.sanpham.product') }}" class="btn btn-outline-secondary mb-3">
                            <i class="bi bi-arrow-left-square"></i> Trở lại
                        </a>

                        <h3>{{ $product->ten_sanpham }}</h3>
                        <p class="mt-3"><strong>Mô tả:</strong> {{ $product->mota }}</p>

                        <div class="price my-3">
                            <span class="act-price fw-bold text-danger">
                                Giá: {{ number_format($product->giasp, 0, ',', '.') }} VNĐ
                            </span>
                        </div>

                        <div class="stock my-3">
                            <span class="fw-bold">Tồn kho: </span>
                            @if($product->stock <= 10)
                                <span class="badge bg-danger">{{ $product->stock }} sản phẩm</span>
                            @elseif($product->stock <= 50)
                                <span class="badge bg-warning">{{ $product->stock }} sản phẩm</span>
                            @else
                                <span class="badge bg-success">{{ $product->stock }} sản phẩm</span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('addcart', $product->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    max="{{ $product->stock }}" class="form-control w-25">
                            </div>
                            @if($product->stock > 0)
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary" disabled>
                                    <i class="fas fa-times-circle"></i> Hết hàng
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Comments Section -->
    <section class="comments-section">
        <div class="container">
            <div class="comments-header">
                <h3 class="comments-title">Bình luận</h3>
                <span class="comment-count">{{ $comments->total() }}</span>
            </div>

            <!-- Comment Form -->
            <div class="comment-form">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="commentForm" action="{{ route('comments.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="commentContent" class="form-label">Viết bình luận của bạn</label>
                        <textarea name="content" id="commentContent" class="form-control" 
                                  placeholder="Chia sẻ ý kiến của bạn về sản phẩm này..." 
                                  maxlength="1000" required></textarea>
                    </div>

                    @if(!Auth::check())
                        <div class="guest-fields">
                            <div>
                                <label for="guest_name" class="form-label">Tên của bạn</label>
                                <input type="text" name="guest_name" id="guest_name" class="form-control" 
                                       placeholder="Nhập tên của bạn" required>
                            </div>
                            <div>
                                <label for="guest_email" class="form-label">Email</label>
                                <input type="email" name="guest_email" id="guest_email" class="form-control" 
                                       placeholder="email@example.com" required>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Gửi bình luận
                    </button>
                </form>
            </div>

            <!-- Comments List -->
            <div class="comments-list">
                @if($comments->count() > 0)
                    @foreach($comments as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <div>
                                    <span class="comment-author">{{ $comment->author_name }}</span>
                                    @if($comment->author_email)
                                        <small class="text-muted">({{ $comment->author_email }})</small>
                                    @endif
                                </div>
                                <small class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="comment-content">
                                {{ $comment->content }}
                            </div>
                            <div class="comment-actions">
                                <button class="btn-like" data-comment-id="{{ $comment->id }}">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="like-count">{{ $comment->likes }}</span>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <div class="comments-pagination">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-comments fa-3x mb-3"></i>
                        <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận về sản phẩm này!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

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
   <script src="../assets/js/product-zoom.js"></script>
   <script src="../assets/js/comments.js"></script>
</body>
</html>