<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();

            // ====== FIELD UTAMA ======
            $table->string('title');                // Judul dokumen
            $table->string('category');             // Kategori (dropdown manual, tanpa relasi)
            $table->unsignedSmallInteger('year');   // Tahun dokumen
            $table->string('authors');              // Penulis
            $table->string('institution')->nullable(); // Institusi (opsional)
            $table->text('keywords')->nullable();   // Kata kunci untuk fitur search
            $table->string('file_path');            // Lokasi file dokumen (hasil upload)

            // ====== ADMINISTRASI ======
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();       // created_at & updated_at
            $table->softDeletes();      // deleted_at untuk SoftDeletes

            // ====== INDEKS UNTUK SEARCH ======
            $table->index('title');
            $table->index('authors');
            $table->index('institution');
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
