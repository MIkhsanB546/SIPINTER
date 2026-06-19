<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materi extends Model
{
    protected $table = 'materi';

    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_teacher',
        'jenjang_id',
        'kategori_materi_id',
        'judul',
        'deskripsi',
        'file_materi',
        'thumbnail',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_teacher', 'id_user');
    }

    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id', 'id_jenjang');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'materi_id', 'id_materi');
    }
}
