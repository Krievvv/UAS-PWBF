<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PanduanController;

use App\Http\Controllers\admin\RekomendasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\KomentarController;
use App\Http\Controllers\user\KomunitasController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'index'])->name('login.view');
Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'indexRegister'])->name('register.view');
Route::get('register/create', [AuthController::class, 'create'])->name('register.create');

// Admin
Route::prefix('admin')->middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/komunitas', [KomunitasController::class, 'indexAdmin'])->name('admin.komunitas');

    // Komentar
    Route::get('/comment/all', [KomentarController::class, 'index'])->name('komentar.index');
    Route::get('/comment/takedown/{id}', [KomentarController::class, 'takedown'])->name('komentar.takedown');
    Route::get('/comment/publish/{id}', [KomentarController::class, 'publish'])->name('komentar.publish');
    Route::get('/comment/delete/{id}', [KomentarController::class, 'delete'])->name('komentar.delete');

    // admin
    Route::get('/komunitas/create', [KomunitasController::class, 'create'])->name('komunitas.create');
    Route::post('/komunitas/store', [KomunitasController::class, 'store'])->name('komunitas.store');
    Route::get('/komunitas/detail/{id}', [KomunitasController::class, 'detail'])->name('komunitas.detail');
    Route::get('/komunitas/takedown/{id}', [KomunitasController::class, 'takedown'])->name('komunitas.takedown');
    Route::get('/komunitas/publish/{id}', [KomunitasController::class, 'publish'])->name('komunitas.publish');
    Route::get('/komunitas/delete/{id}', [KomunitasController::class, 'delete'])->name('komunitas.delete');
    Route::get('/komunitas/delete_member/{id}', [KomunitasController::class, 'delete_member'])->name('komunitas.delete.menber');


    // Panduan
    Route::get('/panduan/all', [PanduanController::class, 'index'])->name('panduan.index');
    Route::post('/panduan/store', [PanduanController::class, 'store'])->name('panduan.store');
    Route::get('/panduan/detail/{id}', [PanduanController::class, 'detail'])->name('panduan.detail');
    Route::get('/panduan/show/{id}', [PanduanController::class, 'show'])->name('panduan.show');
    Route::get('/panduan/update/{id}', [PanduanController::class, 'update'])->name('panduan.update');
    Route::get('/panduan/delete/{id}', [PanduanController::class, 'delete'])->name('panduan.delete');

    // Admin Rekomendasi
    Route::get('/rekomendasi/all', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
    Route::post('/rekomendasi/store', [RekomendasiController::class, 'store'])->name('rekomendasi.store');
    Route::get('/rekomendasi/detail/{id}', [RekomendasiController::class, 'detail'])->name('rekomendasi.detail');
    Route::get('/rekomendasi/update/{id}', [RekomendasiController::class, 'update'])->name('rekomendasi.update');
    Route::get('/rekomendasi/takedown/{id}', [RekomendasiController::class, 'takedown'])->name('rekomendasi.takedown');
    Route::get('/rekomendasi/delete/{id}', [RekomendasiController::class, 'delete'])->name('rekomendasi.delete');
});


// User
Route::post('/komunitas/join/{id}', [KomunitasController::class, 'join'])->name('komunitas.join');
Route::get('/komunitas/all', [KomunitasController::class, 'index'])->name('komunitas.all');
Route::get('/my-komunitas/{id}', [KomunitasController::class, 'myKomunitas'])->name('my.komunitas');
Route::get('/komunitas/show/{id}', [KomunitasController::class, 'show'])->name('komunitas.show');
Route::get('/komunitas/leave/{id}', [KomunitasController::class, 'leave'])->name('komunitas.leave');

// komentar
Route::post('/comment/store/{id}', [KomentarController::class, 'store'])->name('komentar.store');

// group chat
Route::get('/chat/roomchat/{id}', [MessageController::class, 'index'])->name('chat');
Route::get('/chat/{komunitasId}', [MessageController::class, 'fetchMessages']);
Route::post('/chat/send', [MessageController::class, 'sendMessage']);

// Profile
Route::get('/my/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/my/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

// User Panduan
Route::get('/panduan/all', [PanduanController::class, 'index_user'])->name('panduan.user');
Route::get('/panduan/show/{id}', [PanduanController::class, 'show'])->name('panduan.show');

// User Rekomendasi
Route::get('/rekomendasi/all', [RekomendasiController::class, 'index_user'])->name('rekomendasi.user');
Route::get('/rekomendasi/show/{id}', [RekomendasiController::class, 'show'])->name('rekomendasi.show');




