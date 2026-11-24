<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Dijaga dengan hasColumn: aman dijalankan di database yang sudah punya
        // kolom status (mis. punya teman yang bikin tabel dari migration terbaru).
        if (!Schema::hasColumn('ruangans', 'status')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->enum('status', ['tersedia', 'tidak_tersedia'])
                      ->default('tersedia')
                      ->after('lokasi');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ruangans', 'status')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};