<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->string('slug', 280)->unique();

            $table->text('abstract')->nullable();
            $table->string('file_path', 500);

            $table->string('author', 150);
            $table->unsignedSmallInteger('year');
            $table->string('institution', 200);

            $table->enum('status', ['draft', 'published', 'rejected'])
                ->default('draft')
                ->index();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['year', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
