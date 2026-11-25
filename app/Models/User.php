<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'nim', 'nip', 'profile_photo_path',])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const PASSWORD_MIN = 8;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function userRole(): HasOne
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function roleId(): ?int
    {
        $roleId = $this->userRole()->value('role_id');

        if ($roleId) {
            return (int) $roleId;
        }

        // Cadangan untuk akun lama yang belum punya baris user_roles
        return match ($this->role) {
            'pengelola' => Role::PENGELOLA,
            'mahasiswa' => Role::MAHASISWA,
            default     => null,
        };
    }
}