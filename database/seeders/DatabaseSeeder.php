<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RuanganSeeder::class,
        ]);

        // 1. Pastikan role pengelola (1) dan mahasiswa (2) ada
        Role::firstOrCreate(['id' => Role::PENGELOLA], ['nama_role' => 'pengelola']);
        Role::firstOrCreate(['id' => Role::MAHASISWA], ['nama_role' => 'mahasiswa']);

        // 2. Buat / ambil akun admin (pengelola)
        $user = User::firstOrCreate(
            ['email' => 'admin@siplus.local'],
            [
                'name'              => 'Admin SIPLUS',
                'password'          => Hash::make('password123'),
                'role'              => 'pengelola',
                'jenis_identitas'   => 'nip',
                'nomor_identitas'   => '199001012020121001',
                'nip'               => '199001012020121001',
            ]
        );

        // 3. Hubungkan user ke tabel user_roles dengan role_id = 1 (PENGELOLA)
        UserRole::updateOrCreate(
            ['user_id' => $user->id],
            ['role_id' => Role::PENGELOLA]
        );
    }
}