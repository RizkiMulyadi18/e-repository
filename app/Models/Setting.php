<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di phpMyAdmin
    protected $table = 'settings';

    // Izinkan semua kolom diisi (atau sebutkan satu-satu di $fillable)
    protected $guarded = ['id'];
}
