<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index']);

// Registration Routes
Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', Register::class)->middleware('guest');

// Login Routes (Step 3)
// Menampilkan form login hanya untuk tamu (guest)
Route::view('/login', 'auth.login')->middleware('guest')->name('login');
// Memproses data login
Route::post('/login', Login::class)->middleware('guest');

// Protected Routes
// Middleware 'auth' memastikan hanya user yang sudah login yang bisa mengakses
Route::middleware('auth')->group(function () {
    // Logout Route (Step 3)
    Route::post('/logout', Logout::class)->name('logout');

    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
});