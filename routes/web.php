<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananPublicController;
use App\Http\Controllers\PromoPublicController;
use App\Http\Controllers\HalamanController;

// Auth Controller
use App\Http\Controllers\Auth\LoginController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PromoController as AdminPromoController;
use App\Http\Controllers\Admin\PortofolioController as AdminPortofolioController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');

Route::get('/cek-pesanan', [PesananPublicController::class, 'index'])->name('pesanan.cek');
Route::post('/cek-pesanan', [PesananPublicController::class, 'cek'])->name('pesanan.cek.post');
Route::get('/api/cek-pesanan', [PesananPublicController::class, 'cekApi'])->name('pesanan.cek.api');

Route::get('/promo', [PromoPublicController::class, 'index'])->name('promo');
Route::get('/tentang-kami', [HalamanController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/kontak', [HalamanController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Layanan & Kategori
    Route::resource('layanan', AdminLayananController::class)->except(['show']);
    Route::get('kategori', [AdminLayananController::class, 'kategoriIndex'])->name('kategori.index');
    Route::get('kategori/create', [AdminLayananController::class, 'kategoriCreate'])->name('kategori.create');
    Route::post('kategori', [AdminLayananController::class, 'kategoriStore'])->name('kategori.store');
    Route::get('kategori/{kategori}/edit', [AdminLayananController::class, 'kategoriEdit'])->name('kategori.edit');
    Route::put('kategori/{kategori}', [AdminLayananController::class, 'kategoriUpdate'])->name('kategori.update');
    Route::delete('kategori/{kategori}', [AdminLayananController::class, 'kategoriDestroy'])->name('kategori.destroy');

    // Pesanan
    Route::resource('pesanan', AdminPesananController::class);
    Route::patch('pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.status');

    // Promo & Portofolio
    Route::resource('promo', AdminPromoController::class)->except(['show']);
    Route::resource('portofolio', AdminPortofolioController::class)->except(['show']);

    // Pengaturan
    Route::get('pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
});
