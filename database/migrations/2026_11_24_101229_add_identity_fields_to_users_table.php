
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_identitas', 10)->nullable();
            $table->string('nomor_identitas', 30)->nullable()->unique();
        });

        // Memindahkan identitas lama jika sudah tersedia.
        DB::statement("
            UPDATE users
            SET
                jenis_identitas = CASE
                    WHEN nim IS NOT NULL AND nim <> '' THEN 'nim'
                    WHEN nip IS NOT NULL AND nip <> '' THEN 'nip'
                    ELSE NULL
                END,
                nomor_identitas = COALESCE(
                    NULLIF(nim, ''),
                    NULLIF(nip, '')
                )
            WHERE nomor_identitas IS NULL
        ");
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nomor_identitas']);
            $table->dropColumn([
                'jenis_identitas',
                'nomor_identitas',
            ]);
        });
    }
};
