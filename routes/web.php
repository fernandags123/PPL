<?php

use App\Http\Controllers\ProductController;

// HOME → tampilkan katalog
Route::get('/', [ProductController::class, 'index'])->name('home');

// UPLOAD PRODUK
Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');

// HALAMAN KATALOG PRODUK
Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');


// 🔥 ROUTE POST KOMENTAR + RATING (WAJIB UNTUK SRS‐06)
Route::post('/produk/{id}/comment', [ProductController::class, 'storeComment'])
    ->name('produk.comment');

 Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');
