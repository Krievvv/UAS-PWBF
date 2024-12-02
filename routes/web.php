<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\KomunitasController;
use App\Http\Controllers\admin\RekomendasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login.view');
Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('register', [AuthController::class, 'indexRegister'])->name('register.view');
Route::get('register/create', [AuthController::class, 'create'])->name('register.create');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/komunitas', [KomunitasController::class, 'indexAdmin'])->name('admin.komunitas');

    // Admin Rekomendasi
    Route::get('/rekomendasi/all', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
    Route::post('/rekomendasi/store', [RekomendasiController::class, 'store'])->name('rekomendasi.store');
    Route::get('/rekomendasi/detail/{id}', [RekomendasiController::class, 'detail'])->name('rekomendasi.detail');
    Route::get('/rekomendasi/update/{id}', [RekomendasiController::class, 'update'])->name('rekomendasi.update');
    Route::get('/rekomendasi/takedown/{id}', [RekomendasiController::class, 'takedown'])->name('rekomendasi.takedown');
});

Route::get('/komunitas/create', [KomunitasController::class, 'create'])->name('komunitas.create');
Route::post('/komunitas/store', [KomunitasController::class, 'store'])->name('komunitas.store');

// User
Route::get('/komunitas/all', [KomunitasController::class, 'index'])->name('komunitas.all');
Route::get('/komunitas/show/{id}', [KomunitasController::class, 'show'])->name('komunitas.detail');

// Profile
Route::get('/my/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');

// User Rekomendasi
Route::get('/rekomendasi/all', [RekomendasiController::class, 'index_user'])->name('rekomendasi.user');
Route::get('/rekomendasi/show/{id}', [RekomendasiController::class, 'show'])->name('rekomendasi.show');

