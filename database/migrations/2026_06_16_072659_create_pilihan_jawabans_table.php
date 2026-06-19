<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilihan_jawaban', function (Blueprint $table) {
            $table->id('id_pilihan_jawaban');

            $table->foreignId('id_soal')
                ->constrained('soal', 'id_soal')
                ->cascadeOnDelete();

            $table->text('jawaban');

            $table->boolean('is_correct')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilihan_jawaban');
    }
};
