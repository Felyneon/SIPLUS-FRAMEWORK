<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'nama_ruangan',
        'kapasitas',
        'lokasi',
        'status',   // 'tersedia' | 'tidak_tersedia'
    ];

    protected $casts = [
        'kapasitas' => 'integer',
    ];

    public const STATUS_TERSEDIA = 'tersedia';
    public const STATUS_TIDAK_TERSEDIA = 'tidak_tersedia';

    // Relasi: satu ruangan punya banyak peminjaman (model Peminjaman dari anggota lain)
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'ruangan_id');
    }

    // Scope untuk dropdown form peminjaman user
    public function scopeTersedia($query)
    {
        return $query->where('status', self::STATUS_TERSEDIA);
    }
}
