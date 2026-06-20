<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriMateri extends Model
{
  use HasFactory;

  protected $table = 'kategori_materi';

  protected $primaryKey = 'id_kategori_materi';

  protected $fillable = [
    'nama_kategori',
    'deskripsi'
  ];

  public function materi()
  {
    return $this->hasMany(Materi::class, 'id_kategori_materi');
  }
}
