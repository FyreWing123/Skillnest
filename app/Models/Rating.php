<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['pesanan_id', 'umkm_id', 'mahasiswa_id', 'stars', 'ulasan'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function umkm()
    {
        return $this->belongsTo(User::class, 'umkm_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
