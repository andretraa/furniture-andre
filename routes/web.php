<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FurnitureController;
use Illuminate\Support\Facades\Route;

// Home & Catalog routes
Route::get('/', [FurnitureController::class, 'index'])->name('home');
Route::get('/products/{slug}', [FurnitureController::class, 'show'])->name('products.show');

// Auth Routes (Login, Register, Logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
