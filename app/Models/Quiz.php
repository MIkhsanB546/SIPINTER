<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $primaryKey = 'id_quiz';

    protected $fillable = [
        'id_materi',
        'judul',
        'deskripsi',
        'durasi_menit',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_quiz');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'id_quiz');
    }
}
