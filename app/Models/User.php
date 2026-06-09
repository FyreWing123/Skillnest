<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        'name',
        'nickname',
        'email',
        'password',
        'universitas',
        'jurusan',
        'semester',
        'bio',
        'skills',
        'nama_usaha',
        'kategori_usaha',
        'no_whatsapp',
        'alamat_usaha',
        'deskripsi_usaha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function layanans()
    {
        return $this->hasMany(\App\Models\Layanan::class);
    }

    public function portfolios()
    {
        return $this->hasMany(\App\Models\Portfolio::class);
    }

    public function getSkillsArrayAttribute(): array
    {
        if (!$this->skills) return [];
        $decoded = json_decode($this->skills, true);
        return is_array($decoded) ? $decoded : [];
    }
}