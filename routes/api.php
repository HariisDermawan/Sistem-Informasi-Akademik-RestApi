<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'apiLogin']); 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn ($request) => $request->user());
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::apiResource('mahasiswa', MahasiswaController::class);
        Route::apiResource('dosen', DosenController::class);
    });
});
