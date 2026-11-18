<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    public const STATUS_PENDING   = 'Pending';
    public const STATUS_DISETUJUI = 'Disetujui';
    public const STATUS_DITOLAK   = 'Ditolak';

    public const STATUS = [
        self::STATUS_PENDING,
        self::STATUS_DISETUJUI,
        self::STATUS_DITOLAK,
    ];

    protected $fillable = [
        'user_id', 'ruangan_id', 'tanggal_mulai', 'tanggal_selesai',
        'keperluan', 'status', 'alasan_penolakan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai'   => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }
}