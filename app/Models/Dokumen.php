<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth; // ⬅️ tambahkan ini

class Dokumen extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'dokumens';

    protected $fillable = [
    'title',
    'category',
    'year',
    'authors',
    'institution',
    'file_path',
    'user_id',
        
    ];

     public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    protected static function booted(): void
    {
        static::creating(function (Dokumen $doc) {
            if (Auth::check()) {
                $doc->user_id = Auth::id(); // ✅ otomatis isi uploader
            }
        });
    }
     protected $casts = [
        'year' => 'integer',
    ];
}
