<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
{
    /**
     * Izin melihat halaman Pengaturan.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Izin update / simpan Pengaturan.
     */
    public function update(User $user): bool
    {
        return $user->role === 'admin';
    }
}
