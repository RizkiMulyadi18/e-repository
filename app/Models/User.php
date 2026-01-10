<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Import Filament
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class);
    }

    // Helper untuk cek admin (tetap berguna untuk logic lain)
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // --- PERUBAHAN PENTING DI SINI ---
    public function canAccessPanel(Panel $panel): bool
    {
        // Izinkan masuk jika role adalah 'admin' ATAU 'editor'
        return in_array($this->role, ['admin', 'editor']);
    }
}