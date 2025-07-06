<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\HomePageController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\CheckPromoController;
use App\Http\Controllers\User\GoogleAuthController;
use App\Http\Controllers\User\SettingPageController;
use App\Http\Controllers\Admin\SubCategoryController;


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
        Route::apiResource('/product', ProductController::class);
        
        Route::get('/categories/form',[SubCategoryController::class, 'categoryForm']);
        Route::get('/brands/form',[SubCategoryController::class, 'BrandForm']);
        Route::get('/subcategories/form',[SubCategoryController::class, 'SubCategoryForm']);
        
        // site setting 
        Route::apiResource('/banners', BannerController::class);

    });
});


// user

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist', [WishlistController::class, 'add']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'remove']);
    // address
    Route::apiResource('addresses', AddressController::class);
    Route::put('/address/select', [CheckPromoController::class, 'selectAddress']);
    Route::prefix('location')->group(function () {
        Route::get('/divisions', [LocationController::class, 'getDivisions']);
        Route::get('/divisions/{division_id}/districts', [LocationController::class, 'getDistrictsByDivision']);
        Route::get('/districts/{district_id}/upazilas', [LocationController::class, 'getUpazilasByDistrict']);
    });

    // promo code 
    Route::post('/check-promo', [CheckPromoController::class, 'CheckPromo']);

    Route::post('/orders', [OrderController::class, 'store']);

    Route::get('/order/{orderId}',[OrderController::class, 'OrderShow']);

    Route::post('/initiate-payment', [PaymentController::class, 'initiate']);



//     Route::post('/payment/success', [SslCommerzController::class, 'success'])->name('ssl.success');
// Route::post('/payment/fail', [SslCommerzController::class, 'fail'])->name('ssl.fail');
// Route::post('/payment/cancel', [SslCommerzController::class, 'cancel'])->name('ssl.cancel');
// Route::post('/payment/ipn', [SslCommerzController::class, 'ipn']);


// order

Route::get('/my-orders', [OrderController::class, 'myOrders']);

});


Route::get('/home/products', [HomePageController::class, 'HomePageProduct']);

Route::get('/products/search', [HomePageController::class, 'search']);

Route::get('/product/new', [HomePageController::class, 'NewProduct']);
Route::get('/product/best', [HomePageController::class, 'BestSeller']);




Route::get('/single/product/{slug}', [HomePageController::class, 'SingleProduct']);
Route::get('/filter/product', [HomePageController::class, 'FilterProduct']);

// user auth and user profile
Route::post('/user/login', [UserAuthController::class, 'login']);
Route::post('/user/register', [UserAuthController::class, 'register']);

// google login 
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
// Guest & User Cart Routes
Route::post('/cart/add', [CardController::class, 'addToCart']);
Route::get('/cart', [CardController::class, 'getCart']);
Route::put('/cart/item/update', [CardController::class, 'updateItemQuantity']);
Route::delete('/cart/item/{id}', [CardController::class, 'removeFromCart']);

// setting 

Route::get('/banner', [SettingPageController::class, 'banner']);
