<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['GA-101', 'Ruang Teori Kuliah 1A', 'Gedung A • Lantai 1', 45, 'tersedia'],
            ['GA-204', 'Ruang Seminar Manajemen', 'Gedung A • Lantai 2', 35, 'tersedia'],
            ['GB-201', 'Laboratorium Multimedia & Desain', 'Gedung B • Lantai 2', 40, 'tersedia'],
            ['GB-305', 'Laboratorium Pemrograman & Data', 'Gedung B • Lantai 3', 35, 'pemeliharaan'],
            ['GC-101', 'Ruang Rapat Pimpinan & Dosen', 'Gedung C • Lantai 1', 25, 'tersedia'],
            ['GC-300', 'Aula Graha Utama Vokasi', 'Gedung C • Lantai 3', 250, 'tersedia'],
        ];

        foreach ($data as [$kode, $nama, $lokasi, $kapasitas, $status]) {
            Ruangan::updateOrCreate(
                ['kode_ruang' => $kode],
                [
                    'nama_ruangan' => $nama,
                    'lokasi' => $lokasi,
                    'kapasitas' => $kapasitas,
                    'status' => $status,
                ]
            );
        }
    }
}