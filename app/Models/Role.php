<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const PENGELOLA = 1;   // juga berperan sebagai administrator
    public const MAHASISWA = 2;

    // Nama tampilan per role (dipakai di layout dan halaman pengguna)
    public const LABEL = [
        self::PENGELOLA => 'Pengelola',
        self::MAHASISWA => 'Mahasiswa',
    ];

    protected $fillable = ['nama_role'];
}