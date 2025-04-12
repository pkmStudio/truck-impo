<?php

use App\Http\Controllers\Api\V1\Client\ProductController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1/client')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
});
