<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PromocodeController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\WishlistController;
use Illuminate\Http\Request;
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

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);

Route::middleware('auth.verify')->group(function (){
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::get('home',[HomeController::class,'index']);

    Route::prefix('user')->group(function () {
        Route::get('me',[AuthController::class,'profile']);
        Route::get('addresses', [UserAddressController::class,'index']);
        Route::post('address/store', [UserAddressController::class,'store']);
        Route::put('address/update/{id}', [UserAddressController::class,'update']);
        Route::delete('address/delete/{id}', [UserAddressController::class,'delete']);
    });
});

