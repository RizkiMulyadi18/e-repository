<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        return $user->role === 'admin' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function view(User $user, Category $category): bool
    {
        return $user->role === 'editor';
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function update(User $user, Category $category): bool
    {
        return $user->role === 'editor';
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->role === 'editor';
    }

    public function restore(User $user, Category $category): bool
    {
        return $user->role === 'editor';
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return $user->role === 'editor';
    }
}
