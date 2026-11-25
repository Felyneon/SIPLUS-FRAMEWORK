<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RuanganSeeder::class,
        ]);

        // 1. Pastikan role pengelola (1) dan mahasiswa (2) ada
        Role::firstOrCreate(
            ['id' => Role::PENGELOLA],
            ['nama_role' => 'pengelola']
        );

        Role::firstOrCreate(
            ['id' => Role::MAHASISWA],
            ['nama_role' => 'mahasiswa']
        );

        // 2. Buat / ambil akun pengelola (admin)
        $pengelola = User::firstOrCreate(
            ['email' => 'admin@siplus.local'],
            [
                'name'            => 'Admin SIPLUS',
                'password'        => 'password123',
                'role'            => 'pengelola',
                'jenis_identitas' => 'nip',
                'nomor_identitas' => '199001012020121001',
                'nip'             => '199001012020121001',
                'nim'             => null,
            ]
        );

        // 3. Hubungkan akun pengelola ke tabel user_roles (role_id = 1)
        UserRole::updateOrCreate(
            ['user_id' => $pengelola->id],
            ['role_id' => Role::PENGELOLA]
        );
    }
}