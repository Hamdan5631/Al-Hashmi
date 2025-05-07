<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductBiddingController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoldStockController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreProductController;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\UserAjaxController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.index');
})->middleware(['auth:admin'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::resource('employees', EmployeesController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('sold-stocks', SoldStockController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
    Route::post('sold-product', [StockController::class, 'soldProduct'])->name('sold-product');
});
require __DIR__ . '/auth.php';
