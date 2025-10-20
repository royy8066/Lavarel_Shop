<?php

// Backend
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Backend\DanhmucController;
use App\Http\Controllers\Backend\SanphamController;
use App\Http\Controllers\Backend\QlUserController;
use App\Http\Controllers\Backend\QlCheckoutController;

// Frontend
use App\Http\Controllers\Frontend\HometimeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\VnpayController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin
Route::prefix('admin')->name('backend.')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('admin');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('index', [HomeController::class, 'index'])->name('index');
         // Danh mục sản phẩm
         Route::get('category/adddanhmuc', [DanhmucController::class, 'adddanhmuc'])->name('category.adddanhmuc');
         Route::post('category/adddanhmuc', [DanhmucController::class, 'store'])->name('category.store');
         Route::get('category/showdanhmuc', [DanhmucController::class, 'showdanhmuc'])->name('category.showdanhmuc');
         Route::get('category/edit/{id}', [DanhmucController::class, 'edit'])->name('category.edit');
         Route::delete('category/delete/{id}', [DanhmucController::class, 'delete'])->name('category.delete');
         Route::put('category/update/{id}', [DanhmucController::class, 'update'])->name('category.update');
         // Sản phẩm
         Route::get('product/addsanpham', [SanphamController::class, 'addsanpham'])->name('product.addsanpham');
         Route::post('product/store', [SanphamController::class, 'store'])->name('product.store');
         Route::get('product/showsanpham', [SanphamController::class, 'showsanpham'])->name('product.showsanpham');
         Route::get('product/edit/{id}', [SanphamController::class, 'edit'])->name('product.edit');
         Route::delete('product/delete/{id}', [SanphamController::class, 'delete'])->name('product.delete');
         Route::put('product/update/{id}', [SanphamController::class, 'update'])->name('product.update');
         // Quản lý tài khoản user
        Route::get('taikhoan/qltk', [QlUserController::class, 'qltk'])->name('taikhoan.qltk');
        Route::get('taikhoan/{id}/edit', [QlUserController::class, 'edit'])->name('taikhoan.edit');
        Route::post('taikhoan/{id}/update', [QlUserController::class, 'update'])->name('taikhoan.update');
        Route::delete('taikhoan/{id}', [QlUserController::class, 'destroy'])->name('taikhoan.destroy');
         //  QL Đơn hàng
        Route::get('donhang/qldh', [QlCheckoutController::class, 'qldh'])->name('donhang.qldh');
        Route::get('donhang/showdh/{id}', [QlCheckoutController::class, 'showdh'])->name('donhang.showdh');
        Route::delete('donhang/delete/{id}', [QlCheckoutController::class, 'delete'])->name('donhang.delete');
        Route::put('donhang/{id}/duyet', [QlCheckoutController::class, 'duyetdh'])->name('donhang.duyetdh');
         // Hiển thị profile
        Route::get('profile', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'update'])->name('update');
    });
});


// Frontend
Route::get('/', [HometimeController::class, 'index'])->name('frontend.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('frontend.logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('frontend.login');
Route::post('/login', [LoginController::class, 'login'])->name('frontend.login');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('frontend.register');
Route::post('/register', [LoginController::class, 'register'])->name('frontend.register');
Route::get('/blog', [HometimeController::class, 'blog'])->name('frontend.blog');
Route::get('/contact', [HometimeController::class, 'contact'])->name('frontend.contact');
Route::get('/news', [HometimeController::class, 'news'])->name('frontend.news');
Route::get('/tin-tuc/news1', [HometimeController::class, 'news1'])->name('frontend.tintuc.news1');

// sản phẩm
Route::get('product', [ProductController::class, 'product'])->name('frontend.sanpham.product');
Route::get('product2', [ProductController::class, 'product2'])->name('frontend.sanpham.product2');
Route::get('product3', [ProductController::class, 'product3'])->name('frontend.sanpham.product3');
Route::get('product4', [ProductController::class, 'product4'])->name('frontend.sanpham.product4');
Route::get('search', [ProductController::class, 'search'])->name('frontend.search');
Route::get('productdetail/{id}', [ProductController::class, 'productdetail'])->name('frontend.productdetail');

// phân trang sp
Route::get('page1', [PageController::class, 'page1'])->name('frontend.page.page1');
Route::get('page2', [PageController::class, 'page2'])->name('frontend.page.page2');
Route::get('page3', [PageController::class, 'page3'])->name('frontend.page.page3');
Route::get('page4', [PageController::class, 'page4'])->name('frontend.page.page4');

// giỏ hàng
Route::get('frontend/cart', [CartController::class, 'cart'])->name('frontend.cart');
Route::post('addcart/{id}', [CartController::class, 'addcart'])->name('addcart');
Route::post('frontend/updatesp/{id}', [CartController::class, 'updatesp'])->name('frontend.updatesp');
Route::get('frontend/removesp/{id}', [CartController::class, 'removesp'])->name('frontend.removesp');

// thanh toán
Route::post('checkout', [OrderController::class, 'store'])->name('frontend.checkout');
Route::get('checkout', [OrderController::class, 'showCheckoutForm'])->name('frontend.checkout');
Route::post('vnpay', [VnpayController::class, 'vnpay'])->name('frontend.vnpay');
Route::get('/vnpay_return', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');

// lịch sử đơn hàng
Route::get('history', [OrderController::class, 'history'])->name('frontend.lichsu.history');
Route::get('detail/{id}', [OrderController::class, 'detail']) ->name('frontend.lichsu.detail');

// Hiển thị profile
Route::get('profile', [HometimeController::class, 'profile'])->name('frontend.profile')->middleware('auth');
Route::post('update', [HometimeController::class, 'update'])->name('frontend.update')->middleware('auth');