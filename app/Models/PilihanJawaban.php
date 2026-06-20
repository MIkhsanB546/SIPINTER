<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawaban';

    protected $primaryKey = 'id_pilihan_jawaban';

    protected $fillable = [
        'id_soal',
        'jawaban',
        'is_correct'
    ];

    public function soal()
    {
        return $this->belongsTo(
            Soal::class,
            'id_soal'
        );
    }
}
