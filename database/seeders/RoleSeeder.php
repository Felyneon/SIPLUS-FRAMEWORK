<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan menentukan id: pengelola = 1, mahasiswa = 2 (jalankan pada tabel roles yang kosong)
        foreach (['pengelola', 'mahasiswa'] as $nama) {
            Role::firstOrCreate(['nama_role' => $nama]);
        }
    }
}