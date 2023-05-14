<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, "login"]);

Route::prefix("home/produto")->group(function (){
    Route::get('/categorias', [ProductController::class, "categoriesHome"]);
    Route::get('/destaque', [ProductController::class, "featured"]);
    Route::get('/recentes', [ProductController::class, "recent"]);
});

Route::prefix("produto")->group(function (){
    Route::post('/pesquisa', [ProductController::class, "userSearch"]);
    Route::get('/detalhe/{id}', [ProductController::class, "detail"]);

    Route::prefix("catalogo")->group(function (){
        Route::get('/', [ProductController::class, "catalogue"]);
        Route::get('/categoria/{id}', [ProductController::class, "catalogueByCategory"]);
        Route::get('/supercategoria/{id}', [ProductController::class, "catalogueBySuperCategory"]);
    });
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::delete('/logout', [LoginController::class, "logout"]);
});


