<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

// ─────────────────────────────────────────────
// SERVE STORAGE FILES (bypass symlink — Railway safe)
// ─────────────────────────────────────────────
Route::get('/storage/{path}', function (string $path) {
    // Cegah path traversal
    $path = ltrim($path, '/');
    if (str_contains($path, '..')) {
        abort(403);
    }

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $mime = Storage::disk('public')->mimeType($path);
    $stream = Storage::disk('public')->readStream($path);

    return response()->stream(function () use ($stream) {
        fpassthru($stream);
    }, 200, [
        'Content-Type'  => $mime,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('storage.serve');

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