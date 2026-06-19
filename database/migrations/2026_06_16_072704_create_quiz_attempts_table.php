<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id('id_quiz_attempt');

            $table->foreignId('id_student')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->foreignId('id_quiz')
                ->constrained('quiz', 'id_quiz')
                ->cascadeOnDelete();

            $table->decimal('skor_persen', 5, 2)
                ->default(0);

            $table->unsignedTinyInteger('bintang')
                ->default(0);

            $table->timestamp('tanggal_pengerjaan')
                ->useCurrent();

            $table->unsignedTinyInteger('attempt_ke')
                ->default(1);

            $table->timestamps();

            $table->unique([
                'id_student',
                'id_quiz',
                'attempt_ke'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
