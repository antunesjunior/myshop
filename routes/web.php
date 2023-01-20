<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductCatalogueController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockFeedController;
use App\Http\Controllers\SupCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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

Route::get('/', [HomeController::class, "home"])->name('home');

Route::post('/usuario/criar', [UserController::class, "store"])->name('user.store');
Route::post('/usuario/autenticacao', [LoginController::class, "authUser"])->name('user.login');
Route::post('/usuario/admin/autenticacao', [LoginController::class, "authAdmin"])->name('admin.login');
Route::get('/usuario/logout', [LoginController::class, "logoutUser"])->name('user.logout');

Route::get('/produto/pesquisa/', [ProductController::class, "userSearch"])->name('user.search.products');
Route::get('/produto/{id}/detalhe', [ProductController::class, "detail"])->name('product.detail');

Route::get('/produtos/catalogo/todos', [ProductCatalogueController::class, "catalogue"])->name('products.catalogue');
Route::get('/produtos/catalogo/categoria/{id}', [ProductCatalogueController::class, "catalogueByCategory"])->name('products.catalogue.category');
Route::get('/produtos/catalogo/supercategoria/{id}', [ProductCatalogueController::class, "catalogueBySuperCategory"])->name('products.catalogue.supcategory');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [HomeController::class, "homeAdmin"])->name('admin.home');
    Route::get('/home/test', [HomeController::class, "home"])->name('test');

    Route::resource('products', ProductController::class);
    Route::post('/products/search', [ProductController::class, "adminSearch"])->name('products.search');

    Route::resource('cart', CartController::class);
    Route::resource('address', AddressController::class);
    Route::get('/user/shop/{address}', [UserController::class, "shop"])->name('user.shop');
    Route::get('/user/delive/address', [UserController::class, "addressDeliver"])->name('user.address');
    Route::get('/user/shop/{address}/checkout', [UserController::class, "checkout"])->name('user.checkout');
    Route::get('/user/profile', [UserController::class, "profile"])->name('user.profile');
    Route::put('/user/{id}/update', [UserController::class, "update"])->name('user.update');
    Route::get('/usuario/fatura/{id}', [InvoiceController::class, "show"])->name('invoice.show');

    Route::resource('vendors', VendorController::class);
    Route::resource('deliver', DeliverController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('supcategs', SupCategoryController::class);
    Route::resource('feeds', StockFeedController::class);

   
    Route::get('/reports/sale', [ReportController::class, 'sale'])->name('reports.sale');

    Route::get('/reports/caixa', [ReportController::class, 'caixa'])->name('reports.caixa');

    Route::post('/reports/sell', [PdfController::class, 'saleYear'])->name('pdf.sale.year');
    Route::post('/pdf/caixa/year', [PdfController::class, 'caixaYear'])->name('pdf.caixa.year');
    Route::post('/pdf/caixa/month', [PdfController::class, 'caixaMonth'])->name('pdf.caixa.month');
    Route::get('/pdf/caixa/day', [PdfController::class, 'caixaDay'])->name('pdf.caixa.day');
    Route::post('/pdf/caixa/period', [PdfController::class, 'caixaPeriod'])->name('pdf.caixa.period');

    Route::get('/pdf/reports', [PdfController::class, 'reports'])->name('pdf.reports');
    Route::get('/pdf/deliver/{id}', [PdfController::class, 'deliver'])->name('pdf.deliver');
    Route::get('/pdf/products', [PdfController::class, 'products'])->name('pdf.products');
    Route::get('/pdf/vendors', [PdfController::class, 'vendors'])->name('pdf.vendors');
    Route::get('/pdf/stock', [PdfController::class, 'stock'])->name('pdf.stock');
    Route::get('/pdf/invoice/{id}', [PdfController::class, 'invoice'])->name('pdf.invoice');
    
});