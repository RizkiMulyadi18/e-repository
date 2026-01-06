<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Dokumen extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'abstract',
        'file_path',
        'author',
        'year',
        'institution',
        'status',
        'category_id',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::creating(function (Dokumen $dokumen) {
            if (Auth::check()) {
                $dokumen->user_id = Auth::id();
            }
        });

        static::updating(function (Dokumen $dokumen) {
        if (Auth::check()) {
            $dokumen->user_id = Auth::id();
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
