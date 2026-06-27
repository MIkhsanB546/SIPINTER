<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Model pengguna (guru, siswa, admin).
 */
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

    /**
     * Relasi ke materi yang dibuat oleh guru.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_guru');
    }

    /**
     * Relasi ke percobaan quiz yang dilakukan siswa.
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'id_siswa');
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->qr_token)) {
                $user->qr_token = (string) Str::uuid();
            }
        });
    }

    /**
     * Scope untuk filter pengguna dengan role guru.
     */
    public function scopeGuru($query)
    {
        return $query->where('role', 'guru');
    }

    /**
     * Scope untuk filter pengguna dengan role siswa.
     */
    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }
}
