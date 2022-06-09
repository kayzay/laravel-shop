<?php

use App\Http\Controllers\Admin\Shop\CategoryController;
use App\Http\Controllers\Admin\Auth\AdminLogInController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Shop\ProductController;
use App\Http\Controllers\Admin\System\CurrencyController;
use App\Http\Controllers\Admin\System\LanguageController;
use App\Http\Controllers\Admin\Users\AdminUserController;
use App\Http\Controllers\Admin\Users\AdminUserGroupController;
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


Route::prefix('admin')->group(function(){


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:admin');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:admin');
    Route::resource('category', CategoryController::class)->names('category')->middleware('auth:admin');
    Route::resource('product', ProductController::class)->names('product')->middleware('auth:admin');

    Route::resource('language', LanguageController::class)->names('system.language')->middleware('auth:admin');
    Route::resource('currency', CurrencyController::class)->names('system.currency')->middleware('auth:admin');

    Route::resource('admin-users', AdminUserController::class)->names('admin.users')->middleware('auth:admin');
    Route::resource('admin-group', AdminUserGroupController::class)->names('admin.group')->middleware('auth:admin');
    /*
    | Route Grop Auth
    */
    Route::get('login', [AdminLogInController::class, 'login'])->name('login');
    Route::post('sign-in', [AdminLogInController::class, 'signIn'])->name('sign-in');
    Route::get('logout', [AdminLogInController::class, 'logout'])->name('logout');
});
