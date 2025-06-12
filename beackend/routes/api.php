<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    
    Route::middleware(['Admin'])->group(function () {
        Route::get('/test',function (){
            return 'test successfully!';
        });
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::apiResource('/category', CategoryController::class);
        Route::apiResource('/subcategory', SubCategoryController::class);
        Route::apiResource('/brand', BrandController::class);
    });
});