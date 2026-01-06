<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (Auth::check()) {
                $category->user_id = Auth::id();
            }
        });

        static::updating(function (Category $category) {
            if (Auth::check()) {
                $category->user_id = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class);
    }
}
