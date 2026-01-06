<?php

namespace App\Policies;

use App\Models\Dokumen;
use App\Models\User;

class DokumenPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        return $user->role === 'admin' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function view(User $user, Dokumen $dokumen): bool
    {
        return $user->role === 'editor';
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function update(User $user, Dokumen $dokumen): bool
    {
        return $user->role === 'editor';
    }

    public function delete(User $user, Dokumen $dokumen): bool
    {
        return $user->role === 'editor';
    }

    public function restore(User $user, Dokumen $dokumen): bool
    {
        return $user->role === 'editor';
    }

    public function forceDelete(User $user, Dokumen $dokumen): bool
    {
        return $user->role === 'editor';
    }
}
