<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    protected $table = 'ruangans';

    public const STATUS_TERSEDIA     = 'tersedia';
    public const STATUS_PEMELIHARAAN = 'pemeliharaan';

    public const STATUS = [
        self::STATUS_TERSEDIA     => 'Tersedia / Aktif',
        self::STATUS_PEMELIHARAAN => 'Pemeliharaan',
    ];

    protected $fillable = [
        'kode_ruang',
        'nama_ruangan',
        'kapasitas',
        'lokasi',
        'deskripsi',
        'status',
    ];

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'ruangan_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS[$this->status] ?? ucfirst((string) $this->status);
    }
}
