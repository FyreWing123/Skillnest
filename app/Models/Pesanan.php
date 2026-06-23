<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['layanan_id', 'user_id', 'pesan', 'status'];

    const STATUS_LABELS = [
        'menunggu_verifikasi' => 'Menunggu Verifikasi',
        'diterima'            => 'Diterima',
        'on_going'            => 'On-going',
        'selesai'             => 'Selesai',
        'ditolak'             => 'Ditolak',
    ];

    const STATUS_COLORS = [
        'menunggu_verifikasi' => 'bg-yellow-100 text-yellow-700',
        'diterima'            => 'bg-blue-100 text-blue-700',
        'on_going'            => 'bg-purple-100 text-purple-700',
        'selesai'             => 'bg-green-100 text-green-700',
        'ditolak'             => 'bg-red-100 text-red-700',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function statusColor(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'bg-slate-100 text-slate-600';
    }
}
