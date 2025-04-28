<?php


use App\Http\Controllers\Api\V1\Client\BrandController;
use App\Http\Controllers\Api\V1\Client\CategoryController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1/client')->group(function () {
    Route::apiResource('/brands', BrandController::class)->names('api.v1.client.brands')->except('show');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('api.v1.client.categories.show');

});
