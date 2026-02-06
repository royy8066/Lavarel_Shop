<!-- Sidebar -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" src="{{ asset('img/profile_small.jpg') }}" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name ?? Auth::user()->fullname ?? 'Admin' }}</strong></span>
                            <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('frontend.profile') }}">Profile</a></li>
                        <li><a href="{{ route('backend.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    Trầm Hương
                </div>
            </li>

            <li class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">
                <a href="{{ route('backend.admin') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Thống kê</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Doanh thu</a></li>
                    <li><a href="#">Sản phẩm bán chạy</a></li>
                    <li><a href="#">Khách hàng</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Sản Phẩm</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('backend.product.showsanpham') }}">Danh sách sản phẩm</a></li>
                    <li><a href="{{ route('backend.product.addsanpham') }}">Thêm sản phẩm</a></li>
                    <li><a href="{{ route('backend.stock.index') }}">Quản lý Tồn kho</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Danh Mục</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('backend.category.showdanhmuc') }}">Danh sách danh mục</a></li>
                    <li><a href="{{ route('backend.category.adddanhmuc') }}">Thêm danh mục</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Đơn Hàng</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('backend.donhang.qldh') }}">Danh sách đơn hàng</a></li>
                    <li><a href="{{ route('backend.donhang.qldh') }}?status=pending">Đơn hàng chờ xử lý</a></li>
                    <li><a href="{{ route('backend.donhang.qldh') }}?status=completed">Đơn hàng hoàn thành</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Tài Khoản</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('backend.taikhoan.qltk') }}">Danh sách tài khoản</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Báo Cáo</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Báo cáo doanh thu</a></li>
                    <li><a href="#">Báo cáo tồn kho</a></li>
                    <li><a href="#">Báo cáo khách hàng</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Cài Đặt</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Thông tin cửa hàng</a></li>
                    <li><a href="#">Phương thức thanh toán</a></li>
                    <li><a href="#">Cấu hình email</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
