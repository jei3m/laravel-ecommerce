<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');

Route::resource('products', ProductController::class);

Route::get('/browse', [ProductController::class, 'browse'])->name('products.browse');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile');
