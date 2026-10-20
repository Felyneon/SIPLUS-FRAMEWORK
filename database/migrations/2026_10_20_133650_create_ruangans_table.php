<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan'); // Contoh: Lab Komputer 1, Ruang Teori A
            $table->integer('kapasitas');   // Contoh: 30 orang
            $table->string('lokasi');       // Contoh: Gedung A Lantai 2
            $table->text('deskripsi')->nullable();
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
