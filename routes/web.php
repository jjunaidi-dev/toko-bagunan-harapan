<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\DistributorController;

// Halaman Utama Index
Route::get('/', function () {
    return view('index');
})->name('home');

// Route Register Admin
Route::get('/admin/register', [AdminRegisterController::class, 'create'])->name('admin.register');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register.store');

// Route Login & Logout
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Dashboard (Diproteksi Middleware Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route Dashboard (Diproteksi Middleware Auth Admin)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Manajemen Barang
    Route::get('/admin/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/admin/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/admin/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/admin/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Route Kasir / Transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/admin/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/admin/transaksi/api/barang/{id}', [TransaksiController::class, 'getBarangDetail'])->name('transaksi.get-barang');

    //Route Karyawan
    Route::get('/admin/employee', [EmployeController::class, 'index'])->name('employee.index');
    Route::post('/admin/employee', [EmployeController::class, 'store'])->name('employee.store');
    Route::put('/admin/employee/{id}', [EmployeController::class, 'update'])->name('employee.update');
    Route::delete('/admin/employee/{id}', [EmployeController::class, 'destroy'])->name('employee.destroy');

    
    // Route Data Distributor
    Route::get('/admin/distributor', [DistributorController::class, 'index'])->name('distributor.index');
    Route::post('/admin/distributor', [DistributorController::class, 'store'])->name('distributor.store');
    Route::put('/admin/distributor/{id}', [DistributorController::class, 'update'])->name('distributor.update');
    Route::delete('/admin/distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy');


});
