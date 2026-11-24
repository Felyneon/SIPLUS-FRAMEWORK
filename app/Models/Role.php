<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public const PENGELOLA = 1;
    public const MAHASISWA = 2;

    public const LABEL = [
        self::PENGELOLA => 'Pengelola',
        self::MAHASISWA => 'Mahasiswa',
    ];

    protected $fillable = ['nama_role'];

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'role_id', 'id');
    }
}
