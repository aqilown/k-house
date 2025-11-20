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