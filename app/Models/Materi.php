<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_guru',
        'id_tingkat',
        'id_kategori_materi',
        'judul',
        'deskripsi',
        'file_materi',
        'thumbnail',
        'is_published',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id_user');
    }

    public function tingkatKesulitan()
    {
        return $this->belongsTo(TingkatKesulitan::class, 'id_tingkat');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriMateri::class, 'id_kategori_materi');
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'id_materi');
    }

    public function siswa()
    {
        return $this->belongsToMany(User::class, 'materi_siswa', 'id_materi', 'id_siswa')
            ->withPivot(['status', 'progress', 'started_at', 'completed_at'])
            ->withTimestamps();
    }
}
