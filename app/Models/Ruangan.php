<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangans';

    protected $fillable = [
        'kode_ruang',
        'nama_ruangan',
        'kapasitas',
        'lokasi',
        'deskripsi',
        'status',
    ];

    public const STATUS = [
        'tersedia' => 'Tersedia / Aktif',
        'pemeliharaan' => 'Pemeliharaan',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS[$this->status] ?? ucfirst((string) $this->status);
    }
}