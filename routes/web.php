<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products');
})->name('home');

Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
        Route::get('/products/dashboard', [ProductController::class, 'dashboard'])->name('products.dashboard');
        Route::get('/orders/dashboard', [OrderController::class, 'dashboard'])->name('orders.dashboard');
        Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])
            ->name('orders.update-status');
        Route::post('/orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])
            ->name('orders.update-payment-status');
    });


    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/browse', [ProductController::class, 'browse'])->name('products.browse');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Order Routes
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/cancel/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

    // Payment Routes
    Route::get('/payment/{order}/process', [PaymentController::class, 'processPayPal'])->name('payment.process');
    Route::get('/payment/{order}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/{order}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Rating Routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
        Route::put('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/update-address', [ProfileController::class, 'updateAddress'])->name('profile.update-address');
});

require __DIR__.'/auth.php';
