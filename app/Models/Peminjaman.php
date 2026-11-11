<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan database lokal PostgreSQL kita (tanpa huruf 's')
    protected $table = 'peminjaman';

    protected $fillable = [
        'nama_matkul',
        'dosen_pengampu',
        'nama_pjmk',
        'prodi',
        'gedung',
        'ruangan_id',
        'tanggal',
        'alasan',
        'status',
    ];
}


