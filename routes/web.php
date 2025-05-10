<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.main.index');
})->name('admin.index');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/brands', BrandController::class)->names('admin.brands')->except('show');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/products', ProductController::class)->names('admin.products');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/home', [App\Http\Controllers\AdminAuthController::class, 'index'])->name('home');
