<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [LoginController::class, "loginAdmin"])->name('admin.login');
Route::get('/logout', [LoginController::class, "logout"])->name('user.logout');
Route::post('/auth', [LoginController::class, "authentication"])->name('user.auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [HomeController::class, "homeAdmin"])->name('admin.home');
    Route::get('/home/test', [HomeController::class, "home"])->name('test');

    Route::resource('products', ProductController::class);
    
});