<?php

use Illuminate\Support\Facades\Route;

// Homepage statis
Route::get('/', function () {
    return view('home');
})->name('home');

// Login statis
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register statis
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// About statis
Route::get('/about', function () {
    return view('about');
})->name('about');

// Cari Kost statis
Route::get('/cari-kost', function () {
    return view('cari-kost');
})->name('cari-kost');


// Detail Kost statis
Route::get('/kost/{id}', function ($id) {
    return view('detail-kost');
})->name('detail-kost');


// =============  ROUTE ADMIN DASHBOARD  =============
// Admin Dashboard statis
Route::get('/admin/dashboard', function () {
    return view('layouts.admin_dashboard');
})->name('admin.dashboard');

// ADMIN KAMAR
Route::get('/admin/kamar', function () {
    return view('layouts.kamar_admin_dashboard');
})->name('admin.kamar');

// ADMIN PENGHUNI
Route::get('/admin/penghuni', function () {
    return view('layouts.penghuni_admin_dashboard');
})->name('admin.penghuni');



// Profile statis
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
