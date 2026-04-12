<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\AuthController;

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

// DASHBOARD
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');

    if (!session('user_id')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
    }

    return view('admin.dashboard');

})->name('admin.dashboard');

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/peta-umkm', function () {
    return view('map');
})->name('map.umkm');

Route::get('/admin/data-umkm', function () {

    if (!session('user_id')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
    }

    return view('admin.data-umkm');

})->name('admin.data.umkm');

Route::get('/katalog-umkm', function () {
    return view('katalog');
})->name('katalog.umkm');

Route::get('/dashboard-potensi', function () {
    return view('dashboard-potensi');
})->name('dashboard.potensi');
