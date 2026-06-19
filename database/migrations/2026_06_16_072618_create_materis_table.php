<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');

            $table->foreignId('id_guru')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->foreignId('id_jenjang')
                ->constrained('jenjang', 'id_jenjang')
                ->cascadeOnDelete();

            $table->foreignId('id_kategori_materi')
                ->constrained('kategori_materi', 'id_kategori_materi')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi')->nullable();

            $table->string('file_materi')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
