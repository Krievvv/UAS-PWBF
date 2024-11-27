<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\KomunitasController;
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
    
});

Route::get('/komunitas/create', [KomunitasController::class, 'create'])->name('komunitas.create');
Route::post('/komunitas/store', [KomunitasController::class, 'store'])->name('komunitas.store');

// User
Route::get('/komunitas/all', [KomunitasController::class, 'index'])->name('komunitas.all');
Route::get('/komunitas/show/{id}', [KomunitasController::class, 'show'])->name('komunitas.detail');

