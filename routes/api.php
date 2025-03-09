<?php

use App\Http\Controllers\Api\V1\Address\AddressController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogOutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Banner\BannerController;
use App\Http\Controllers\Api\V1\Carts\CartsController;
use App\Http\Controllers\Api\V1\CheckOutProducts\CheckOutProductsController;
use App\Http\Controllers\Api\V1\Notification\NotificationController;
use App\Http\Controllers\Api\V1\Notification\ReadAtNotificationController;
use App\Http\Controllers\Api\V1\Orders\OrdersController;
use App\Http\Controllers\Api\V1\Otp\OtpSendController;
use App\Http\Controllers\Api\V1\Otp\OtpVerifyController;
use App\Http\Controllers\Api\V1\Payment\PaymentVerifyController;
use App\Http\Controllers\Api\V1\PlaceBid\PlaceBidController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use App\Http\Controllers\Api\V1\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Api\V1\ProductWishlist\ProductWishListController;
use App\Http\Controllers\Api\V1\PurchaseCoins\PurchaseCoinsController;
use App\Http\Controllers\Api\V1\PurchaseProduct\PurchaseProductController;
use App\Http\Controllers\Api\V1\Transactions\TransactionsController;
use App\Http\Controllers\Api\V1\Transmit\TransmitController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('otp-send', OtpSendController::class);
Route::get('otp-verify', OtpVerifyController::class);
Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('forgot-password', ForgotPasswordController::class);
Route::apiResource('products', ProductController::class)->only('index');
Route::get('product-categories', ProductCategoryController::class);
Route::get('banners', BannerController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('employees', UserController::class)->except('index');
    Route::apiResource('addresses', AddressController::class);
    Route::get('products-calculations', [ProductController::class, 'calculations']);
    Route::apiResource('products', ProductController::class)->except('index');
    Route::post('payment-verify', PaymentVerifyController::class);
    Route::post('purchase-coins', PurchaseCoinsController::class);
    Route::post('purchase-product', PurchaseProductController::class);
    Route::post('checkout-products', CheckOutProductsController::class);
    Route::post('place-bid', PlaceBidController::class);
    Route::post('add-to-wishlist', ProductWishListController::class);
    Route::apiResource('orders', OrdersController::class)->only('index', 'show');
    Route::apiResource('notifications', NotificationController::class)->only('index');
    Route::post('notification-read/{id}', ReadAtNotificationController::class);
    Route::post('return-order/{id}', [OrdersController::class,'returnOrder']);
    Route::post('cancel-order', [OrdersController::class,'cancelOrder']);
    Route::get('transactions', TransactionsController::class);
    Route::post('transmit', TransmitController::class);
    Route::post('logout', LogOutController::class);
    Route::post('delete-account',[UserController::class,'deleteAccount'])->name('delete-account');
    Route::prefix('carts')->controller(CartsController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/add', 'add');
        Route::post('/remove', 'remove');
        Route::post('/quantity-change', 'quantityChange');
    });
});
