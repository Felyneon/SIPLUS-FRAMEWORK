<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_ruangan' => 'Lab Komputer 1',      'kapasitas' => 40,  'lokasi' => 'Gedung Vokasi Lantai 1', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Lab Komputer 2',      'kapasitas' => 40,  'lokasi' => 'Gedung Vokasi Lantai 1', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Ruang Kelas A1',      'kapasitas' => 35,  'lokasi' => 'Gedung Vokasi Lantai 2', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Ruang Kelas A2',      'kapasitas' => 35,  'lokasi' => 'Gedung Vokasi Lantai 2', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Ruang Seminar',       'kapasitas' => 100, 'lokasi' => 'Gedung Vokasi Lantai 3', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Aula Vokasi',         'kapasitas' => 250, 'lokasi' => 'Gedung Vokasi Lantai Dasar', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Ruang Rapat Dosen',   'kapasitas' => 20,  'lokasi' => 'Gedung Vokasi Lantai 3', 'status' => 'tersedia'],
            ['nama_ruangan' => 'Lab Multimedia',      'kapasitas' => 30,  'lokasi' => 'Gedung Vokasi Lantai 2', 'status' => 'tidak_tersedia'],
        ];

        foreach ($data as $row) {
            // firstOrCreate: aman dijalankan berulang tanpa duplikat
            Ruangan::firstOrCreate(['nama_ruangan' => $row['nama_ruangan']], $row);
        }
    }
}