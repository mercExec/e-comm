<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('addCookieProductsToDB', [CartProductController::class, 'addCookieProductsToDB'])->name('addCookieProductsToDB');
    Route::post('cart/updateQuantityInDB/{cartProduct}', [CartProductController::class, 'updateQuantityInDB'])->name('updateQuantityInDB');
    Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout/{order}', [CheckoutController::class, 'checkoutOrder'])->name('checkoutWithSession');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');


});

Route::prefix('admin')->middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    // Products
    Route::apiResource('/products', ProductController::class);
    // Orders
    Route::get('/orders', [AdminOrderController::class, 'getOrders']);
    Route::post('/orders/update/{order}', [AdminOrderController::class, 'updateOrderStatus']);
    // Users
    Route::get('/users', [AdminUserController::class, 'getUsers']);
    Route::post('/users/delete/{user}', [AdminUserController::class, 'destroy']);

});

Route::get('products', [ControllersProductController::class, 'index']);
Route::get('products/{product}', [ControllersProductController::class, 'show']);

Route::get('cart', [CartProductController::class, 'getAllProducts'])->name('cart');
Route::post('cart/updateQuantityInCookie', [CartProductController::class, 'updateQuantityInCookie'])->name('updateQuantityInCookie');
Route::post('cart/deleteProductFromCookie', [CartProductController::class, 'deleteProductFromCookie'])->name('deleteProductFromCookie');
Route::get('cart/deleteProductFromDB/{cartProduct}', [CartProductController::class, 'deleteProductFromDB'])->name('deleteProductFromDB');
Route::post('cart/{product}', [CartProductController::class, 'addProductToCart'])->name('addToCart');


