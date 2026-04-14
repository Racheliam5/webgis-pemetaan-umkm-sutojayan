<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// Optional alias /home
Route::get('/home', [HomeController::class, 'index'])->name('home.alias');

// LOGIN
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// REGISTER
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD ADMIN
Route::get('/admin/dashboard', function () {
    if (!session('user_id')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
    }

    return view('admin.dashboard');
})->name('admin.dashboard');

// PETA UMKM
Route::get('/peta-umkm', function () {
    return view('map');
})->name('map.umkm');

// KATALOG
Route::get('/katalog-umkm', function () {
    return view('katalog');
})->name('katalog.umkm');

// DASHBOARD POTENSI
Route::get('/dashboard-potensi', function () {
    return view('dashboard-potensi');
})->name('dashboard.potensi');

// DATA UMKM
Route::get('/admin/data-umkm', [UmkmController::class, 'index'])->name('admin.data.umkm');
Route::get('/admin/data-umkm/create', [UmkmController::class, 'create'])->name('umkm.create');
Route::post('/admin/data-umkm', [UmkmController::class, 'store'])->name('umkm.store');
Route::get('/admin/data-umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
Route::put('/admin/data-umkm/{id}', [UmkmController::class, 'update'])->name('umkm.update');
Route::delete('/admin/data-umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');
