<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Arahkan halaman utama ke Controller kita
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/dokumen/{id}', [PublicController::class, 'show'])->name('dokumen.show');
