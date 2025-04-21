<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Routes untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/all-products', [ProductController::class, 'allProduct'])->name('all-products');
Route::get('/popular-items', [HomeController::class, 'popularItems'])->name('popular-items');
Route::get('/new-arrivals', [HomeController::class, 'newArrivals'])->name('new-arrivals');

// Routes untuk produk pada halaman admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route to display a specific product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Routes untuk cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// routes/web.php
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Routes untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');