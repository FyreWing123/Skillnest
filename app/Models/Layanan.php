<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'user_id', 'nama', 'kategori', 'harga',
        'estimasi', 'thumbnail', 'deskripsi_singkat',
        'deskripsi_detail', 'status', 'ketersediaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function isOpen(): bool
    {
        return $this->ketersediaan === 'open';
    }

    public function formatHarga(): string
    {
        $num = $this->harga;
        if ($num >= 1_000_000) {
            $jt = $num / 1_000_000;
            $label = fmod($jt, 1) === 0.0 ? (int)$jt : number_format($jt, 1, ',', '');
            return 'Rp' . $label . 'Jt';
        }
        if ($num >= 1_000) {
            return 'Rp' . round($num / 1_000) . 'K';
        }
        return 'Rp' . $num;
    }
}
