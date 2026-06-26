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
        'id_jenjang',
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

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }

    public function kategori()
    {
        return $this->belongsTo(
            KategoriMateri::class,
            'id_kategori_materi'
        );
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'id_materi');
    }
}
