<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// user
Route::resource('products', ProductController::class);

// cart (session)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// admin
Route::get('/admin/admins', [AdminController::class, 'index']);
Route::get('/admin/admins/create', [AdminController::class, 'create']);
Route::post('/admin/admins', [AdminController::class, 'store']);
Route::get('/admin/admins/{id}/edit', [AdminController::class, 'edit']);
Route::post('/admin/admins/{id}', [AdminController::class, 'update']);
Route::get('/admin/admins/{id}/delete', [AdminController::class, 'destroy']);

// admin products
Route::get('/admin/products', [AdminProductController::class, 'index']);
Route::get('/admin/products/create', [AdminProductController::class, 'create']);
Route::post('/admin/products', [AdminProductController::class, 'store']);
Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit']);
Route::post('/admin/products/{id}', [AdminProductController::class, 'update']);
Route::post('/admin/products/{id}/delete', [AdminProductController::class, 'destroy']);

// profile (user chỉnh sửa thông tin cá nhân)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

