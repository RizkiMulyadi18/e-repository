<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','role'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // v10+: otomatis hash ketika di-set
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
