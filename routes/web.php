<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;


Route::get('/', fn() => view('auth.login'))->name('login');
Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
    });
});
