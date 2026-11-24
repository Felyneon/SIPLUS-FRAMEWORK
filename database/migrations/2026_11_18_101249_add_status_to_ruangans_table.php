<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ruangans', 'status')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->string('status', 20)->default('tersedia');
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
