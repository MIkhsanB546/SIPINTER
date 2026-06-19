<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $primaryKey = 'id_quiz_attempt';

    protected $fillable = [
        'id_student',
        'quiz_id',
        'skor_persen',
        'bintang',
        'tanggal_pengerjaan',
    ];

    protected $casts = [
        'skor_persen' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_student', 'id_user');
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id_quiz');
    }
}
