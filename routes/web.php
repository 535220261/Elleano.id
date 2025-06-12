<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfilePictureController;
use Illuminate\Support\Facades\Route;

// Routes untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/all-products', [ProductController::class, 'allProduct'])->name('all-products');
Route::get('/popular-items', [HomeController::class, 'popularItems'])->name('popular-items');
Route::get('/new-arrivals', [HomeController::class, 'newArrivals'])->name('new-arrivals');

// Routes untuk produk pada halaman admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admindashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Routes untuk menampilkan produk spesifik
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Routes untuk cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/update', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');
Route::post('/cart/delete', [CartController::class, 'ajaxDelete'])->name('cart.ajaxDelete');

// routes/web.php
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Routes untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [AccountController::class, 'index'])->name('profile');
Route::post('/profile-picture/create', [ProfilePictureController::class, 'create'])->name('profile-picture.create');
Route::get('/profile-picture/edit', [ProfilePictureController::class, 'edit'])->name('profile-picture.edit');
Route::post('/profile-picture/update', [ProfilePictureController::class, 'update'])->name('profile-picture.update');
Route::delete('/profile-picture', [ProfilePictureController::class, 'destroy'])->name('profile-picture.destroy');

Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/payment-transaction', function () {
    return view('profile.payment_transaction');
})->name('payment_transaction');

Route::get('/security', function () {
    return view('profile.security');
})->name('security');
Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change.password');


Route::get('/notifications', function () {
    return view('profile.notifications');
})->name('notifications');
