<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();
            $table->foreignId('id_materi')
                ->constrained('materi', 'id_materi')
                ->cascadeOnDelete();
            $table->enum('status', ['saved', 'learning', 'completed'])->default('saved');
            $table->integer('progress')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['id_siswa', 'id_materi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_siswa');
    }
};
