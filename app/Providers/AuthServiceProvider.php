<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Dokumen;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\DokumenPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Dokumen::class => DokumenPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
