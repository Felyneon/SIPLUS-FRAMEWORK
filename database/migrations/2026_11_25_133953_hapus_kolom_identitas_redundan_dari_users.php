<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Pindahkan identitas ke kolom aslinya berdasarkan role.
        DB::statement("
            UPDATE users
            SET nim = nomor_identitas
            WHERE role = 'mahasiswa'
              AND (nim IS NULL OR nim = '')
              AND nomor_identitas IS NOT NULL
        ");

        DB::statement("
            UPDATE users
            SET nip = nomor_identitas
            WHERE role = 'pengelola'
              AND (nip IS NULL OR nip = '')
              AND nomor_identitas IS NOT NULL
        ");

        // 2. Lepas unique index lalu hapus kolom redundan.
        if (Schema::hasIndex('users', 'nomor_identitas', 'unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['nomor_identitas']);
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['jenis_identitas', 'nomor_identitas']);
        });

        // 3. Pastikan NIM dan NIP unik (NULL boleh banyak di PostgreSQL).
        if (! Schema::hasIndex('users', 'nim', 'unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('nim');
            });
        }

        if (! Schema::hasIndex('users', 'nip', 'unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('nip');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_identitas', 10)->nullable();
            $table->string('nomor_identitas', 30)->nullable()->unique();
        });

        DB::statement("
            UPDATE users
            SET
                jenis_identitas = CASE WHEN nim IS NOT NULL THEN 'nim' ELSE 'nip' END,
                nomor_identitas = COALESCE(nim, nip)
        ");
    }
};