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



Route::middleware(['is_guest'])->group(function () {
    Route::get('/', [HomeController::class, "home"])->name('home');

    Route::prefix('usuario')->group(function () {
        Route::post('/criar', [UserController::class, "store"])->name('user.store');
        Route::post('/login', [LoginController::class, "authUser"])->name('user.login');
        Route::post('/admin/login', [LoginController::class, "authAdmin"])->name('admin.login');     
    });

    Route::resource('cart', CartController::class);

    Route::prefix('produto')->group(function () {
        Route::get('/pesquisa', [ProductController::class, "userSearch"])->name('user.search.products');
        Route::get('/{id}/detalhe', [ProductController::class, "detail"])->name('product.detail');

        Route::prefix('catalogo')->group(function () {
            Route::get('/todos', [ProductCatalogueController::class, "catalogue"])->name('products.catalogue');
            Route::get('/categoria/{id}', [ProductCatalogueController::class, "catalogueByCategory"])->name('products.catalogue.category');
            Route::get('/supercategoria/{id}', [ProductCatalogueController::class, "catalogueBySuperCategory"])->name('products.catalogue.supcategory');
        });
    });
});

Route::middleware(['auth', 'is_customer'])->group(function () {

    Route::prefix('cliente')->group(function () {
        Route::get('/perfil', [UserController::class, "profile"])->name('user.profile');
        Route::put('/{id}/editar', [UserController::class, "update"])->name('user.update');
        Route::get('/compra/{address}', [UserController::class, "shop"])->name('user.shop');
        Route::get('/enderecos', [UserController::class, "addressDeliver"])->name('user.address');
        Route::get('/compra/{address}/verificacao', [UserController::class, "checkout"])->name('user.checkout');
        Route::get('/fatura/{id}', [InvoiceController::class, "show"])->name('invoice.show');
        Route::get('/logout', [LoginController::class, "logout"])->name('user.logout');
    });

    Route::resource('address', AddressController::class)->except(['create', 'show']);
});

Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, "homeAdmin"])->name('admin.home');

    Route::resource('vendors', VendorController::class);
    Route::resource('deliver', DeliverController::class);
    Route::resource('feeds', StockFeedController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('supcategs', SupCategoryController::class);
    Route::resource('products', ProductController::class)->except('edit');
    Route::post('/products/search', [ProductController::class, "adminSearch"])->name('products.search');

    Route::get('/relatorios', [PdfController::class, 'reports'])->name('pdf.reports');

    Route::prefix('relatorio')->group(function () {
        Route::get('/venda', [ReportController::class, 'sale'])->name('reports.sale');
        Route::get('/caixa', [ReportController::class, 'caixa'])->name('reports.caixa');
        //Route::post('/reports/sell', [PdfController::class, 'saleYear'])->name('pdf.sale.year');

        Route::prefix('caixa')->group(function () {
            Route::post('/ano', [PdfController::class, 'caixaYear'])->name('pdf.caixa.year');
            Route::post('/mes', [PdfController::class, 'caixaMonth'])->name('pdf.caixa.month');
            Route::get('/dia', [PdfController::class, 'caixaDay'])->name('pdf.caixa.day'); 
            Route::post('/periodo', [PdfController::class, 'caixaPeriod'])->name('pdf.caixa.period');
        });

        Route::get('/entrega/{id}', [PdfController::class, 'deliver'])->name('pdf.deliver');
        Route::get('/produtos', [PdfController::class, 'products'])->name('pdf.products');
        Route::get('/fornecedor', [PdfController::class, 'vendors'])->name('pdf.vendors');
        Route::get('/stock', [PdfController::class, 'stock'])->name('pdf.stock');
        Route::get('/factura/{id}', [PdfController::class, 'invoice'])->name('pdf.invoice');
        
    });
});
