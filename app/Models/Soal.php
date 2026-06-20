<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_quiz',
        'pertanyaan'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(
            PilihanJawaban::class,
            'id_soal'
        );
    }
}
