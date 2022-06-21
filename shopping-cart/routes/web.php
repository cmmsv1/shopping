<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/getData', [HomeController::class, 'getData'])->name('home.data');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/read', [ShopController::class, 'read'])->name('shop.read');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/remove-cart-item', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::get('/getDataCarts', [CartController::class, 'getDataCarts'])->name('cart.getDataCarts');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.order');
    Route::post('/checkout/checkPaypal', [CheckoutController::class, 'checkPaypal'])->name('checkout.checkPaypal');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/product/detail/{slug}', [ProductDetailController::class, 'index'])->name('product.detail');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/read', [SearchController::class, 'read'])->name('search.read');
Route::get('/categories/{slug}', [SearchController::class, 'searchCategories'])->name('search.categories');
Route::get('/categories-parent/{slug}', [SearchController::class, 'searchParentCategories'])->name('search.parentcategories');
Route::get('/search/readCategories', [SearchController::class, 'readCategories'])->name('search.readCategories');
Route::middleware('auth')->group(function () {
    //user
    Route::prefix('user')->group(function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('orders', [UserOrderController::class, 'index'])->name('user.orders');
        Route::get('orders/detail/{id}', [UserOrderController::class, 'detail'])->name('user.orders.detail');
        Route::post('orders/update/{id}', [UserOrderController::class, 'update'])->name('user.orders.update');
        Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
        Route::post('profile/updateProfile', [UserProfileController::class, 'updateProfile'])->name('user.profile.updateProfile');
        Route::post('profile/changePass', [UserProfileController::class, 'changePass'])->name('user.profile.changePass');
        Route::get('address', [AddressController::class, 'index'])->name('user.address');
        Route::post('address/update', [AddressController::class, 'updateAddress'])->name('user.address.update');
    });
});
Route::middleware(['auth', 'authadmin'])->group(function () {
    //admin
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        //users
        Route::get('users', [UserController::class, 'index'])->name('admin.users');
        Route::get('users/getData', [UserController::class, 'getData'])->name('admin.users.getdata');
        Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::delete('users/remove/{id}', [UserController::class, 'remove'])->name('admin.users.remove');
        //categories
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('categories/read', [CategoryController::class, 'read'])->name('admin.categories.read');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::delete('categories/remove/{id}', [CategoryController::class, 'remove'])->name('admin.categories.remove');
        // Products
        Route::get('products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('products/read', [ProductController::class, 'read'])->name('admin.products.read');
        Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('products/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::delete('products/remove/{id}', [ProductController::class, 'remove'])->name('admin.products.remove');
        // Order
        Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('orders/detail/{id}', [OrderController::class, 'detail'])->name('admin.orders.detail');
        Route::post('orders/detail/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::get('orders/item', [OrderController::class, 'getItem'])->name('admin.orders.item');
        //home slider
        Route::get('home-slider', [HomeSliderController::class, 'index'])->name('admin.sliders');
        Route::get('home-slider/read', [HomeSliderController::class, 'read'])->name('admin.sliders.read');
        Route::get('home-slider/create', [HomeSliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('home-slider/store', [HomeSliderController::class, 'store'])->name('admin.sliders.store');
        Route::get('home-slider/edit/{id}', [HomeSliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::delete('home-slider/remove/{id}', [HomeSliderController::class, 'remove'])->name('admin.sliders.remove');
        //banner
        Route::get('banner', [BannerController::class, 'index'])->name('admin.banners');
        Route::get('banner/read', [BannerController::class, 'read'])->name('admin.banners.read');
        Route::get('banner/create', [BannerController::class, 'create'])->name('admin.banners.create');
        Route::post('banner/store', [BannerController::class, 'store'])->name('admin.banners.store');
        Route::get('banner/edit/{id}', [BannerController::class, 'edit'])->name('admin.banners.edit');
        Route::delete('banner/remove/{id}', [BannerController::class, 'remove'])->name('admin.banners.remove');
        //custom
        Route::get('custom', [CustomController::class, 'index'])->name('admin.custom');
        Route::get('custom/logo', [CustomController::class, 'logo'])->name('admin.custom.logo');
        Route::post('custom/logo/update', [CustomController::class, 'updateLogo'])->name('admin.custom.logo.update');
        Route::get('custom/info', [CustomController::class, 'info'])->name('admin.custom.info');
        Route::post('custom/info/update', [CustomController::class, 'updateInfo'])->name('admin.custom.info.update');
        Route::get('custom/social', [CustomController::class, 'social'])->name('admin.custom.social');
        Route::post('custom/social/update', [CustomController::class, 'updateSocial'])->name('admin.custom.social.update');
    });
});


//paypal
Route::get('create-transaction', [PaypalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
