<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MateriSiswa extends Pivot
{
    protected $table = 'materi_siswa';

    protected $fillable = [
        'id_siswa',
        'id_materi',
        'status',
        'progress',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id_user');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
