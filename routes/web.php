<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockFeedController;
use App\Http\Controllers\SupCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, "home"])->name('index.home');

Route::get('/user/login', [LoginController::class, "login"])->name('user.login');
Route::get('/user/create', [LoginController::class, "regist"])->name('user.create');
Route::post('/user/create', [UserController::class, "store"])->name('user.store');
Route::get('/admin/login', [LoginController::class, "loginAdmin"])->name('admin.login');

Route::post('/user/auth', [LoginController::class, "authUser"])->name('user.auth');
Route::post('/user/admin', [LoginController::class, "authAdmin"])->name('admin.auth');

Route::get('/user/logout', [LoginController::class, "logoutUser"])->name('user.logout');
Route::get('/admin/logout', [LoginController::class, "logoutAdmin"])->name('admin.logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [HomeController::class, "homeAdmin"])->name('admin.home');
    Route::get('/home/test', [HomeController::class, "home"])->name('test');

    Route::resource('products', ProductController::class);
    Route::post('/products/search', [ProductController::class, "search"])->name('products.search');

    Route::resource('vendors', VendorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('supcategs', SupCategoryController::class);
    Route::resource('feeds', StockFeedController::class);

    Route::get('/pdf/reports', [PdfController::class, 'reports'])->name('pdf.reports');
    Route::get('/pdf/products', [PdfController::class, 'products'])->name('pdf.products');
    Route::get('/pdf/vendors', [PdfController::class, 'vendors'])->name('pdf.vendors');
    Route::get('/pdf/stock', [PdfController::class, 'stock'])->name('pdf.stock');
    
});