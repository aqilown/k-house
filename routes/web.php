<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// ========== HALAMAN PUBLIK ==========

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/cari-kost', function () {
    return view('cari-kost');
})->name('cari-kost');

Route::get('/kost/{id}', function ($id) {
    return view('detail-kost');
})->name('detail-kost');

// ========== AUTHENTICATION ==========

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// ========== ADMIN PANEL ==========

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/kost', [AdminController::class, 'kost'])->name('kost');
    Route::get('/kamar', [AdminController::class, 'kamar'])->name('kamar');
    Route::get('/booking', [AdminController::class, 'booking'])->name('booking');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
});