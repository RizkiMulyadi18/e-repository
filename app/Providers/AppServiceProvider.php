<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// WAJIB: Import Model dan Observer yang akan kita gunakan
use App\Models\User;
use App\Models\Role;
use App\Models\Repository;
use App\Models\Category; // <-- TAMBAHAN: Wajib di-import
use App\Observers\AuditObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- DAFTARKAN OBSERVER DI SINI ---
        
        // Daftarkan AuditObserver untuk setiap Model yang memiliki kolom user_id
        // Ini mengaktifkan fitur Audit Trail otomatis.
        // User::observe(AuditObserver::class);
        // Role::observe(AuditObserver::class);
        // Repository::observe(AuditObserver::class);
        // Category::observe(AuditObserver::class); // <-- DAFTARKAN CATEGORY DI SINI
        
        // -------------------------------------
    }
}