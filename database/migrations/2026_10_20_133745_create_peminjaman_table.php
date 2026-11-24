<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ruangan_id')->constrained('ruangans')->restrictOnDelete();
            $table->string('nama_matkul', 150);
            $table->string('dosen_pengampu', 150);
            $table->string('prodi', 100);
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->text('keperluan');
            $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->index(['ruangan_id', 'status', 'tanggal_mulai', 'tanggal_selesai'], 'peminjaman_jadwal_index');
            $table->index(['user_id', 'created_at'], 'peminjaman_user_created_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
