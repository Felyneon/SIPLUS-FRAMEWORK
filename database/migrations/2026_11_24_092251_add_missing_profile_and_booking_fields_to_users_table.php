<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Role ID 1 dan 2 dipakai oleh Role::PENGELOLA dan Role::MAHASISWA.
        if (Schema::hasTable('roles')) {
            DB::table('roles')->updateOrInsert(
                ['id' => 1],
                ['nama_role' => 'pengelola', 'created_at' => now(), 'updated_at' => now()]
            );
            DB::table('roles')->updateOrInsert(
                ['id' => 2],
                ['nama_role' => 'mahasiswa', 'created_at' => now(), 'updated_at' => now()]
            );
        }

        if (Schema::hasTable('peminjaman')) {
            $addNamaMatkul = ! Schema::hasColumn('peminjaman', 'nama_matkul');
            $addDosen = ! Schema::hasColumn('peminjaman', 'dosen_pengampu');
            $addProdi = ! Schema::hasColumn('peminjaman', 'prodi');

            if ($addNamaMatkul || $addDosen || $addProdi) {
                Schema::table('peminjaman', function (Blueprint $table) use ($addNamaMatkul, $addDosen, $addProdi) {
                    if ($addNamaMatkul) $table->string('nama_matkul', 150)->nullable();
                    if ($addDosen) $table->string('dosen_pengampu', 150)->nullable();
                    if ($addProdi) $table->string('prodi', 100)->nullable();
                });
            }
        }

        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'profile_photo_path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('profile_photo_path')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('peminjaman')) {
            $dropNamaMatkul = Schema::hasColumn('peminjaman', 'nama_matkul');
            $dropDosen = Schema::hasColumn('peminjaman', 'dosen_pengampu');
            $dropProdi = Schema::hasColumn('peminjaman', 'prodi');

            if ($dropNamaMatkul || $dropDosen || $dropProdi) {
                Schema::table('peminjaman', function (Blueprint $table) use ($dropNamaMatkul, $dropDosen, $dropProdi) {
                    if ($dropNamaMatkul) $table->dropColumn('nama_matkul');
                    if ($dropDosen) $table->dropColumn('dosen_pengampu');
                    if ($dropProdi) $table->dropColumn('prodi');
                });
            }
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'profile_photo_path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('profile_photo_path');
            });
        }
    }
};
