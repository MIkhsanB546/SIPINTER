<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PilihanJawaban extends Model
{
    protected $table = 'pilihan_jawaban';

    protected $primaryKey = 'id_pilihan_jawaban';

    protected $fillable = [
        'soal_id',
        'jawaban',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function soal(): BelongsTo
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id_soal');
    }
}
