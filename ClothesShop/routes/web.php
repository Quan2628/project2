<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Database\Seeders\CategoryProductSeeder;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

// Xử lý đăng nhập / đăng xuất admin
Route::get('/admin', [AdminController::class, 'index'])->name('login');
Route::get('/create', [AdminController::class, 'create'])->name('create');
Route::post('/register', [AdminController::class, 'register'])->name('register');
Route::post('/logon', [AdminController::class, 'logon'])->name('logon');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Xử lý đăng nhập / đăng xuất user
Route::get('/user', [HomeController::class, 'index_user'])->name('login');
Route::post('/logon_user', [HomeController::class, 'logon_user'])->name('logon_user');
Route::get('/logout_user', [HomeController::class, 'logout_user'])->name('logout_user');
Route::post('/register_user', [HomeController::class, 'register_user'])->name('register_user');
// Bảo vệ bởi authentication => phải đăng nhập mới có quyền truy cập
// Route::middleware('auth')->prefix('/admin')->group(function(){    
//     Route::get('/index', [HomeController::class, 'index'])->name('admin.index');
//     Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
// });


//frontend
Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::post('/search', [HomeController::class, 'search'])->name('search');

//category_brand_home
Route::get('/category_home/{cat_id}', [CategoryProductController::class, 'category'])->name('category_home');
Route::get('/brand_home/{brand_id}', [BrandProductController::class, 'brand'])->name('brand_home');
Route::get('/product_details/{product_id}', [ProductController::class, 'product_details'])->name('product_details');

//Cart
Route::post('/save_cart', [CartController::class, 'save_cart'])->name('save_cart');
Route::post('/update_cart', [CartController::class, 'update_cart'])->name('update_cart');
Route::get('/show_cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::get('/delete_cart/{rowId}', [CartController::class, 'delete_cart'])->name('delete_cart');

//Checkout
Route::get('/login_checkout', [CheckoutController::class, 'login_checkout'])->name('login_checkout');
Route::get('/logout_checkout', [CheckoutController::class, 'logout_checkout'])->name('logout_checkout');
Route::post('/login_customer', [CheckoutController::class, 'login_customer'])->name('login_customer');
Route::post('/add_customer', [CheckoutController::class, 'add_customer'])->name('add_customer');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::post('/save_checkout', [CheckoutController::class, 'save_checkout'])->name('save_checkout');
Route::post('/order', [CheckoutController::class, 'order'])->name('order');




//backend
//dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//category_product
Route::get('/add_cat', [CategoryProductController::class, 'add_cat'])->name('add_cat');
Route::get('/all_cat', [CategoryProductController::class, 'all_cat'])->name('all_cat');

Route::get('/edit_cat/{cat_product_id}', [CategoryProductController::class, 'edit_cat'])->name('edit_cat');
Route::get('/delete_cat/{cat_product_id}', [CategoryProductController::class, 'delete_cat'])->name('delete_cat');
Route::post('/save_cat_product', [CategoryProductController::class, 'save_cat_product'])->name('save_cat_product');
Route::post('/update_cat/{cat_product_id}', [CategoryProductController::class, 'update_cat'])->name('update_cat');

Route::get('/unactive_cat/{cat_product_id}', [CategoryProductController::class, 'unactive_cat'])->name('unactive_cat');
Route::get('/active_cat/{cat_product_id}', [CategoryProductController::class, 'active_cat'])->name('active_cat');

//brand_product
Route::get('/add_brand', [BrandProductController::class, 'add_brand'])->name('add_brand');
Route::get('/all_brand', [BrandProductController::class, 'all_brand'])->name('all_brand');

Route::get('/edit_brand/{brand_product_id}', [BrandProductController::class, 'edit_brand'])->name('edit_brand');
Route::get('/delete_brand/{brand_product_id}', [BrandProductController::class, 'delete_brand'])->name('delete_brand');
Route::post('/save_brand_product', [BrandProductController::class, 'save_brand_product'])->name('save_brand_product');
Route::post('/update_brand/{brand_id}', [BrandProductController::class, 'update_brand'])->name('update_brand');

Route::get('/unactive_brand/{brand_product_id}', [BrandProductController::class, 'unactive_brand'])->name('unactive_brand');
Route::get('/active_brand/{brand_product_id}', [BrandProductController::class, 'active_brand'])->name('active_brand');

//product
Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product');
Route::get('/all_product', [ProductController::class, 'all_product'])->name('all_product');

Route::get('/edit_product/{product_id}', [ProductController::class, 'edit_product'])->name('edit_product');
Route::get('/delete_product/{product_id}', [ProductController::class, 'delete_product'])->name('delete_product');
Route::post('/save_product', [ProductController::class, 'save_product'])->name('save_product');
Route::post('/update_product/{product_id}', [ProductController::class, 'update_product'])->name('update_product');

Route::get('/unactive_product/{product_id}', [ProductController::class, 'unactive_product'])->name('unactive_product');
Route::get('/active_product/{product_id}', [ProductController::class, 'active_product'])->name('active_product');

//order
Route::get('/manage_order', [CheckoutController::class, 'manage_order'])->name('manage_order');
Route::get('/view_order/{order_id}', [CheckoutController::class, 'view_order'])->name('view_order');

//banner
Route::get('/manage_banner', [SliderController::class, 'manage_banner'])->name('manage_banner');
Route::get('/add_banner', [SliderController::class, 'add_banner'])->name('add_banner');
Route::post('/insert_banner', [SliderController::class, 'insert_banner'])->name('insert_banner');

Route::get('/unactive_slider/{slider_id}', [SliderController::class, 'unactive_slider'])->name('unactive_slider');
Route::get('/active_slider/{slider_id}', [SliderController::class, 'active_slider'])->name('active_slider');
Route::get('/delete_slider/{slider_id}', [SliderController::class, 'delete_slider'])->name('delete_slider');
