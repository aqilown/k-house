<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboard;
use App\Http\Controllers\Pemilik\KostManagementController;
use App\Http\Controllers\Pemilik\BookingManagementController;
use App\Http\Controllers\User\DashboardController as UserDashboard;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kost/{id}', [KostController::class, 'show'])->name('kost.show');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::post('/booking/{id}/upload-payment', [BookingController::class, 'uploadPayment'])->name('booking.upload');
    });

    // Review route
    Route::post('/kost/{id}/review', [KostController::class, 'storeReview'])->name('kost.review');

    // Pemilik routes
    Route::prefix('pemilik')->name('pemilik.')->middleware('check.pemilik')->group(function () {
        Route::get('/dashboard', [PemilikDashboard::class, 'index'])->name('dashboard');
        
        // Kost management
        Route::get('/kost', [KostManagementController::class, 'index'])->name('kost.index');
        Route::get('/kost/create', [KostManagementController::class, 'create'])->name('kost.create');
        Route::post('/kost', [KostManagementController::class, 'store'])->name('kost.store');
        Route::get('/kost/{id}/edit', [KostManagementController::class, 'edit'])->name('kost.edit');
        Route::put('/kost/{id}', [KostManagementController::class, 'update'])->name('kost.update');
        Route::delete('/kost/{id}', [KostManagementController::class, 'destroy'])->name('kost.destroy');
        
        // Kamar management
        Route::get('/kost/{id}/kamars', [KostManagementController::class, 'kamars'])->name('kost.kamars');
        Route::get('/kost/{id}/kamars/create', [KostManagementController::class, 'createKamar'])->name('kost.kamars.create');
        Route::post('/kost/{id}/kamars', [KostManagementController::class, 'storeKamar'])->name('kost.kamars.store');
        Route::get('/kost/{kostId}/kamars/{kamarId}/edit', [KostManagementController::class, 'editKamar'])->name('kost.kamars.edit');
        Route::put('/kost/{kostId}/kamars/{kamarId}', [KostManagementController::class, 'updateKamar'])->name('kost.kamars.update');
        Route::delete('/kost/{kostId}/kamars/{kamarId}', [KostManagementController::class, 'destroyKamar'])->name('kost.kamars.destroy');
        
        // Fasilitas management
        Route::get('/kost/{id}/fasilitas', [KostManagementController::class, 'fasilitas'])->name('kost.fasilitas');
        Route::get('/kost/{id}/fasilitas/create', [KostManagementController::class, 'createFasilitas'])->name('kost.fasilitas.create');
        Route::post('/kost/{id}/fasilitas', [KostManagementController::class, 'storeFasilitas'])->name('kost.fasilitas.store');
        Route::delete('/kost/{kostId}/fasilitas/{fasilitasId}', [KostManagementController::class, 'destroyFasilitas'])->name('kost.fasilitas.destroy');
        
        // Booking management
        Route::get('/bookings', [BookingManagementController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{id}/approve', [BookingManagementController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{id}/reject', [BookingManagementController::class, 'reject'])->name('bookings.reject');
    });
});