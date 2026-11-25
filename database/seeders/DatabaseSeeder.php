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
        // Menyiapkan role dan data ruangan
        $this->call([
            RoleSeeder::class,
            RuanganSeeder::class,
        ]);

        // Membuat atau mengambil akun pengelola
        $pengelola = User::firstOrCreate(
            ['email' => 'admin@siplus.local'],
            [
                'name'     => 'Admin SIPLUS',
                'password' => 'password123',
                'role'     => 'pengelola',
                'nip'      => '199001012020121001',
                'nim'      => null,
            ]
        );

        // Memastikan akun pengelola memiliki role pengelola
        UserRole::updateOrCreate(
            ['user_id' => $pengelola->id],
            ['role_id' => Role::PENGELOLA]
        );
    }
}
