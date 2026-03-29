<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

// Public Shop Routes
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{id}', [ProductController::class, 'show'])->name('shop.show');

// Basic Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Auth & Profile
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::get('/user/confirm-password', function () { return view('auth.confirm-password'); })->name('password.confirm');
});

// Admin Area
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});