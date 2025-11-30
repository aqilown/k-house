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

// Admin Dashboard statis
Route::get('/admin/dashboard', function () {
    return view('layouts.admin_dashboard');
});

// Detai Kost statis
Route::get('/kost/{id}', function ($id) {
    return view('detail-kost');
})->name('detail-kost');
