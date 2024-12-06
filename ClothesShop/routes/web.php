<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
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

// Xử lý đăng nhập / đăng xuất
Route::get('/admin', [AdminController::class, 'index'])->name('login');
Route::get('/create', [AdminController::class, 'create'])->name('create');
Route::post('/register', [AdminController::class, 'register'])->name('register');
Route::post('/logon', [AdminController::class, 'logon'])->name('logon');

// Bảo vệ bởi authentication => phải đăng nhập mới có quyền truy cập
// Route::middleware('auth')->prefix('/admin')->group(function(){    
//     Route::get('/index', [HomeController::class, 'index'])->name('admin.index');
//     Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
// });


//frontend
Route::get('/index', [HomeController::class, 'index'])->name('index');


























//backend
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
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
Route::get('/order', []);
