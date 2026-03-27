<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{slug}', [ProductController::class, 'show'])->name('shop.show');

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/profile', function () {
    return view('profile'); 
})->middleware('auth')->name('profile');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// This will be use if the data of products will put to database
/*
Route::get('/shop', function () {
    $products = Product::all();
    return view('shop', compact('products'));
})->name('shop');
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::get('/user/confirm-password', function () {
    return view('auth.confirm-password');
})->middleware('auth')->name('password.confirm');

