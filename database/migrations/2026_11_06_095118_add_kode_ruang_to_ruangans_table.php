<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ruangans', 'kode_ruang')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->string('kode_ruang', 20)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ruangans', 'kode_ruang')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->dropColumn('kode_ruang');
            });
        }
    }
};
