<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua route yang harus login
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Buku
    Route::resource('buku', BukuController::class);
    Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
    Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');

   // Anggota
Route::get('/anggota/export', [AnggotaController::class, 'export'])
    ->name('anggota.export');

Route::get('/anggota/search', [AnggotaController::class, 'search'])
    ->name('anggota.search');

Route::resource('anggota', AnggotaController::class);

    // Transaksi
    // Laporan
Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])
    ->name('transaksi.laporan');

Route::get('/transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])
    ->name('transaksi.laporan.pdf');

// Pengembalian
Route::put('/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])
    ->name('transaksi.kembalikan');

// Resource HARUS PALING BAWAH
Route::resource('transaksi', TransaksiController::class);
});

require __DIR__.'/auth.php';