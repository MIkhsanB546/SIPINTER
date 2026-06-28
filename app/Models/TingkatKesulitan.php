<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TingkatKesulitan extends Model
{
    use HasFactory;

    protected $table = 'tingkat_kesulitan';

    protected $primaryKey = 'id_tingkat';

    protected $fillable = [
        'nama_tingkat'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_tingkat');
    }
}
