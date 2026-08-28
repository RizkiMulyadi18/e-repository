<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Livewire\Admin\CategoryIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\DokumenIndex;
use App\Livewire\Admin\SettingsIndex;
use App\Livewire\Admin\UserIndex;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. PUBLIC ROUTES (Halaman Pengunjung)
// ==========================================
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/dokumen/{slug}', [PublicController::class, 'show'])->name('dokumen.show');
Route::get('/download/{slug}', [PublicController::class, 'download'])->name('dokumen.download');

// ==========================================
// 2. CUSTOM ADMIN PANEL (Saweria Neobrutalism)
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest Routes (Login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Authenticated Admin & Editor Routes
    Route::middleware(['auth', 'can:access-admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard & Main Modules
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/dokumens', DokumenIndex::class)->name('dokumens');
        Route::get('/categories', CategoryIndex::class)->name('categories');
        Route::get('/laporan/cetak', [ReportController::class, 'cetakLaporan'])->name('laporan.cetak');

        // Admin-Only Modules
        Route::middleware('can:admin-only')->group(function () {
            Route::get('/users', UserIndex::class)->name('users');
            Route::get('/settings', SettingsIndex::class)->name('settings');
        });
    });
});
