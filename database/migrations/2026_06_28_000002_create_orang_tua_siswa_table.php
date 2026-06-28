<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orang_tua_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_orang_tua')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();
            $table->foreignId('id_siswa')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['id_orang_tua', 'id_siswa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orang_tua_siswa');
    }
};
