<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/admin/laporan/cetak', [ReportController::class, 'cetakLaporan'])
    ->name('laporan.cetak')
    ->middleware('auth'); // Hanya admin login yang bisa akses
// Arahkan halaman utama ke Controller kita
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/dokumen/{slug}', [PublicController::class, 'show'])->name('dokumen.show');
// Route khusus untuk download file + hitung statistik
Route::get('/download/{slug}', [PublicController::class, 'download'])->name('dokumen.download');
