<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home & Catalog routes
Route::get('/', [FurnitureController::class, 'index'])->name('home');
Route::get('/products/{slug}', [FurnitureController::class, 'show'])->name('products.show');

// Articles & Company Profile routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Auth Routes (Login, Register, Logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated User Routes (Profile & Logout)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Panel Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/articles', [AdminController::class, 'articles'])->name('articles.index');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminController::class, 'destroyArticle'])->name('articles.destroy');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::patch('/users/{user}/role', [AdminController::class, 'toggleUserRole'])->name('users.toggle-role');
});
