<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriBukuController as AdminKategoriBukuController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PesanKontakController as AdminPesanKontakController;

/*
|--------------------------------------------------------------------------
| Web Routes - Bookstore Eko Haryono
|--------------------------------------------------------------------------
| Routes untuk aplikasi toko buku dengan role admin dan user
*/

// ========== PUBLIC ROUTES ==========
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Buku - List & Detail
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/{buku:slug}', [BukuController::class, 'show'])->name('buku.show');

// ========== USER ROUTES (Butuh Authentication) ==========
Route::middleware(['auth'])->group(function () {
    // Keranjang Belanja
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [PesananController::class, 'store'])->name('checkout.store');
    Route::post('/pesanan/{pesanan}/upload-bukti', [PesananController::class, 'uploadBukti'])->name('pesanan.upload-bukti');
    Route::post('/pesanan/{pesanan}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
});

// ========== ADMIN ROUTES (Butuh Authentication + Role Admin) ==========
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori Buku - Full CRUD
    Route::resource('kategori', AdminKategoriBukuController::class);

    // Buku - Full CRUD
    Route::resource('buku', AdminBukuController::class);

    // User - List & Detail
    Route::get('user', [AdminUserController::class, 'index'])->name('user.index');
    Route::get('user/{user}', [AdminUserController::class, 'show'])->name('user.show');

    // Pesanan - List, Detail, Update Status
    Route::get('pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::patch('pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::post('pesanan/{pesanan}/konfirmasi', [AdminPesananController::class, 'konfirmasiPembayaran'])->name('pesanan.konfirmasi');

    // Pesan Kontak - List, Detail, Delete
    Route::get('pesan', [AdminPesanKontakController::class, 'index'])->name('pesan.index');
    Route::get('pesan/{pesan}', [AdminPesanKontakController::class, 'show'])->name('pesan.show');
    Route::delete('pesan/{pesan}', [AdminPesanKontakController::class, 'destroy'])->name('pesan.destroy');
});

// Auth Routes (akan kita buat middleware-nya)
require __DIR__.'/auth.php';
