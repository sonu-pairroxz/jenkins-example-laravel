<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\ImportController;
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
//Front Routes
Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('users.reset_password');
Route::post('reset-password-post', [AuthController::class, 'resetPasswordPost'])->name('users.reset_password.post');

Route::get('/','Admin\Auth\AdminAuthController@index');

Route::group(['middleware' => ['auth','verified']], function(){
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::post('profile.update', 'HomeController@update')->name('profile.update');
    Route::get('change-password', 'HomeController@changePassword')->name('change-password');
    Route::post('update-password', 'HomeController@updatePassword')->name('update-password');
});

//Admin routes


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/','Auth\AdminAuthController@index')->name('adminLogin');
    Route::post('admin.login', 'Auth\AdminAuthController@login')->name('adminLoginPost');
    Route::get('admin.logout', 'Auth\AdminAuthController@logout')->name('adminLogout');

	Route::group(['middleware' => ['adminauth']], function(){
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::post('file-import', [ImportController::class, 'fileImport'])->name('file-import');
        Route::get('htuses', [ImportController::class, 'allHtus'])->name('all-htus');
        Route::get('editRoute', [ImportController::class, 'edit'])->name('editRoute');
        Route::get('getItem/{id}', [ImportController::class, 'get'])->name('getItem');
        Route::delete('deleteItem/{id}', [ImportController::class, 'get'])->name('deleteItem');
	});
});


require __DIR__.'/auth.php';
