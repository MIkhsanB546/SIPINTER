<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soal extends Model
{
    protected $table = 'soal';

    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id_quiz');
    }

    public function pilihanJawabans(): HasMany
    {
        return $this->hasMany(PilihanJawaban::class, 'soal_id', 'id_soal');
    }
}
