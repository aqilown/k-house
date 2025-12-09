<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;

// Halaman Utama

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/cari-kost', [App\Http\Controllers\HomeController::class, 'cariKost'])->name('cari-kost');

Route::get('/kost/{id}', [App\Http\Controllers\HomeController::class, 'detailKost'])->name('detail-kost');

// Review (harus login)
Route::post('/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('review.store')->middleware('auth');
Route::delete('/review/{id}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('review.delete')->middleware('auth');

// Auth User

Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'userLogout'])->name('logout')->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password')->middleware('auth');

// Auth Admin

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Kelola Kost
    Route::get('/kost', [AdminController::class, 'kost'])->name('kost');
    Route::post('/kost/store', [AdminController::class, 'storeKost'])->name('kost.store');
    Route::get('/kost/{id}', [AdminController::class, 'getKost'])->name('kost.get');
    Route::put('/kost/{id}', [AdminController::class, 'updateKost'])->name('kost.update');
    Route::delete('/kost/{id}', [AdminController::class, 'deleteKost'])->name('kost.delete');
    
    // Kelola Kamar
    Route::get('/kamar', [AdminController::class, 'kamar'])->name('kamar');
    Route::post('/kamar/store', [AdminController::class, 'storeKamar'])->name('kamar.store');
    Route::get('/kamar/{id}', [AdminController::class, 'getKamar'])->name('kamar.get');
    Route::put('/kamar/{id}', [AdminController::class, 'updateKamar'])->name('kamar.update');
    Route::delete('/kamar/{id}', [AdminController::class, 'deleteKamar'])->name('kamar.delete');
    
    // Kelola Booking
    Route::get('/booking', [AdminController::class, 'booking'])->name('booking');
    Route::get('/booking/{id}/detail', [AdminController::class, 'getBookingDetail'])->name('booking.detail');
    Route::put('/booking/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('booking.status');
    Route::delete('/booking/{id}', [AdminController::class, 'deleteBooking'])->name('booking.delete');
    
    // Kelola User
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}/detail', [AdminController::class, 'getUserDetail'])->name('users.detail');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
});