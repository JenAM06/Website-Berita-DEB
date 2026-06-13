<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

// ─────────────────────────────────────────────
// ROUTE PUBLIK (Pengunjung)
// ─────────────────────────────────────────────

// Beranda
Route::get('/', [PublicController::class, 'home'])->name('home');

// Daftar semua berita + search
Route::get('/berita', [PublicController::class, 'index'])->name('posts.index');

// Detail berita
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('posts.show');

// Berita berdasarkan kategori
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('category.show');

// Halaman tentang
Route::get('/tentang', [PublicController::class, 'about'])->name('about');


// ─────────────────────────────────────────────
// ROUTE ADMIN (Butuh Login)
// ─────────────────────────────────────────────

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Berita
    Route::resource('posts', PostController::class);

    // Manajemen Kategori
    Route::resource('categories', CategoryController::class);
});


// ─────────────────────────────────────────────
// AUTH ROUTES (dari Breeze)
// ─────────────────────────────────────────────

require __DIR__.'/auth.php';