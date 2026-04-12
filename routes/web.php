<?php

use Illuminate\Support\Facades\Route;
use App\Models\Order;
// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController; // Public Controller
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController; 
use App\Http\Controllers\Auth\PasswordController;
// Admin Controllers (Aliased to avoid name collision with public ProductController)
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;


// PUBLIC ROUTES

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Shop
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{id}', [ProductController::class, 'show'])->name('shop.show');

// Auth Guest Routes
Route::get('/login', function () { return view('auth.login'); })->name('login');


// AUTHENTICATED USER ROUTES
// 'verified' comment if may error sa verification
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile & Security
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::get('/user/confirm-password', function () { return view('auth.confirm-password'); })->name('password.confirm');

    // Profile settings
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/settings/password', [PasswordController::class, 'update'])->name('profile.password.update');

    // Checkout & Payments
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // GCash Flow (Removed the {order} parameter)
    Route::get('/payment/gcash', [CheckoutController::class, 'gcashPayment'])->name('payment.gcash');
    Route::post('/payment/verify', [CheckoutController::class, 'verifyPayment'])->name('payment.verify');

    // User Orders
    Route::get('/orders/{order}', function (Order $order) {
        if ($order->user_id !== auth()->id()) { abort(403); }
        return view('orders.show', compact('order'));
    })->name('orders.show');
});

 // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// ADMIN ROUTES

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product Management (Uses the Admin-specific Controller)
    Route::resource('products', AdminProductController::class);

    // Order Management
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.update-payment');

    // User Management
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});