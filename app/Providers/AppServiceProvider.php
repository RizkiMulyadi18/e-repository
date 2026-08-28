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
        // --- GATES AUTHORIZATION UNTUK ADMIN PANEL ---
        \Illuminate\Support\Facades\Gate::define('access-admin', function (User $user) {
            return in_array($user->role, ['admin', 'editor']);
        });

        \Illuminate\Support\Facades\Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });
    }
}