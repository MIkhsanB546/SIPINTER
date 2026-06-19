<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriMateri extends Model
{
  protected $table = 'kategori_materi';

  protected $primaryKey = 'id_kategori_materi';

  protected $fillable = [
    'nama_kategori',
    'deskripsi',
  ];

  public function materis(): HasMany
  {
    return $this->hasMany(Materi::class, 'kategori_materi_id', 'id_kategori_materi');
  }
}
