<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// user
Route::resource('products', ProductController::class);

// admin
Route::get('/admin/admins', [AdminController::class, 'index']);
Route::get('/admin/admins/create', [AdminController::class, 'create']);
Route::post('/admin/admins', [AdminController::class, 'store']);
Route::get('/admin/admins/{id}/edit', [AdminController::class, 'edit']);
Route::post('/admin/admins/{id}', [AdminController::class, 'update']);
Route::get('/admin/admins/{id}/delete', [AdminController::class, 'destroy']);

