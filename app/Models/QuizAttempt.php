<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $table = 'quiz_attempts';

    protected $primaryKey = 'id_quiz_attempt';

    protected $fillable = [
        'id_student',
        'id_quiz',
        'skor_persen',
        'bintang',
        'tanggal_pengerjaan',
        'attempt_ke',
    ];

    public function student()
    {
        return $this->belongsTo(
            User::class,
            'id_student'
        );
    }

    public function quiz()
    {
        return $this->belongsTo(
            Quiz::class,
            'id_quiz'
        );
    }
}
