<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenjang extends Model
{
    use HasFactory;

    protected $table = 'jenjang';

    protected $primaryKey = 'id_jenjang';

    protected $fillable = [
        'nama_jenjang'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_jenjang');
    }
}
