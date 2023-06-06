<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JitLearningController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\QueryController;
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

// Route::group(['middleware' => ['auth','verified']], function(){
//     Route::get('profile', 'HomeController@profile')->name('profile');
//     Route::post('profile.update', 'HomeController@update')->name('profile.update');
//     Route::get('change-password', 'HomeController@changePassword')->name('change-password');
//     Route::post('update-password', 'HomeController@updatePassword')->name('update-password');
// });

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
        Route::get('getDetail/{id}', [ImportController::class, 'getDetail'])->name('getDetail');
        Route::post('saveItem/{id}', [ImportController::class, 'update'])->name('saveItem');
        Route::delete('deleteItem/{id}', [ImportController::class, 'delete'])->name('deleteItem');

        Route::get('removeall', [ImportController::class, 'removeAll'])->name('remove-all');


        Route::prefix('query')->group(function(){
            Route::get('', [QueryController::class, 'index'])->name('query.index');
            Route::get('data', [QueryController::class, 'data'])->name('query.list.data');
            Route::get('create', [QueryController::class, 'create'])->name('query.create');
            Route::get('edit/{id}', [QueryController::class, 'edit'])->name('query.edit');
            Route::post('update/{id}', [QueryController::class, 'update'])->name('query.update');
            Route::post('store', [QueryController::class, 'store'])->name('query.store');
            Route::get('show/{id}', [QueryController::class, 'show'])->name('query.show');
            Route::get('export', [QueryController::class, 'export'])->name('query.export');
            Route::get('remove-all', [QueryController::class, 'removeAll'])->name('query.remove-all');
        });

        //jit learning
        Route::prefix('jit-learning')->group(function(){
            Route::get('', [JitLearningController::class, 'index'])->name('jit-learning.index');
            Route::get('data', [JitLearningController::class, 'data'])->name('jit-learning.list.data');
            Route::get('create', [JitLearningController::class, 'create'])->name('jit-learning.create');
            Route::get('edit/{id}', [JitLearningController::class, 'edit'])->name('jit-learning.edit');
            Route::post('update/{id}', [JitLearningController::class, 'update'])->name('jit-learning.update');
            Route::post('store', [JitLearningController::class, 'store'])->name('jit-learning.store');
            Route::get('show/{id}', [JitLearningController::class, 'show'])->name('jit-learning.show');
            Route::delete('delete/{id}', [JitLearningController::class, 'destroy'])->name('jit-learning.delete');
            Route::get('export', [JitLearningController::class, 'export'])->name('jit-learning.export');
            Route::get('remove-all', [JitLearningController::class, 'removeAll'])->name('jit-learning.remove-all');
            Route::post('import-quiz', [JitLearningController::class, 'fileImport'])->name('import-quiz');
        });

        //news
        Route::prefix('news')->group(function(){
            Route::get('', [NewsController::class, 'index'])->name('news.index');
            Route::get('data', [NewsController::class, 'data'])->name('news.list.data');
            Route::get('create', [NewsController::class, 'create'])->name('news.create');
            Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
            Route::post('update/{id}', [NewsController::class, 'update'])->name('news.update');
            Route::post('store', [NewsController::class, 'store'])->name('news.store');
            Route::get('show/{id}', [NewsController::class, 'show'])->name('news.show');
            Route::delete('delete/{id}', [NewsController::class, 'destroy'])->name('news.delete');
            Route::get('export', [NewsController::class, 'export'])->name('news.export');
            Route::get('remove-all', [NewsController::class, 'removeAll'])->name('news.remove-all');
            Route::post('product/img', [NewsController::class, 'uploadMedia'])->name('admin.product.uploadMedia');

        });
	});
});


require __DIR__.'/auth.php';
