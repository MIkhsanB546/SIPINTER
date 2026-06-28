<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
        'qr_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_guru');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'id_siswa');
    }

    // Student saved/learning materials
    public function materiSiswa()
    {
        return $this->belongsToMany(Materi::class, 'materi_siswa', 'id_siswa', 'id_materi')
            ->withPivot(['status', 'progress', 'started_at', 'completed_at'])
            ->withTimestamps();
    }

    // Parent: students linked to this parent
    public function anak()
    {
        return $this->belongsToMany(
            User::class,
            'orang_tua_siswa',
            'id_orang_tua',
            'id_siswa'
        )->withTimestamps();
    }

    // Student: parents linked to this student
    public function orangTua()
    {
        return $this->belongsToMany(
            User::class,
            'orang_tua_siswa',
            'id_siswa',
            'id_orang_tua'
        )->withTimestamps();
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->qr_token)) {
                $user->qr_token = (string) Str::uuid();
            }
        });
    }

    public function scopeGuru($query)
    {
        return $query->where('role', 'guru');
    }

    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }
}
