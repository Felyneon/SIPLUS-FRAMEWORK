
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $incomplete = DB::table('users')
            ->whereNull('jenis_identitas')
            ->orWhereNull('nomor_identitas')
            ->exists();

        if ($incomplete) {
            throw new RuntimeException(
                'Masih ada pengguna yang belum memiliki identitas.'
            );
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_identitas', 10)
                ->nullable(false)
                ->change();

            $table->string('nomor_identitas', 30)
                ->nullable(false)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenis_identitas', 10)
                ->nullable()
                ->change();

            $table->string('nomor_identitas', 30)
                ->nullable()
                ->change();
        });
    }
};
