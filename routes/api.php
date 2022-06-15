<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;

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



Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.api');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::apiResource('/customer', 'App\Http\Controllers\Customer\CustomerController');
        Route::apiResource('/category', 'App\Http\Controllers\Product\CategoryController');
        Route::apiResource('/product', 'App\Http\Controllers\Product\ProductController');
        Route::apiResource('/blog_category', 'App\Http\Controllers\Product\BlogCategoryController');
        Route::apiResource('/blog', 'App\Http\Controllers\Product\BlogController');
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout.api');
    });
    
});
