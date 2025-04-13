<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.main.index');
})->name('admin.index');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/brands', BrandController::class)->names('admin.brands');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/products', ProductController::class)->names('admin.products');
});
