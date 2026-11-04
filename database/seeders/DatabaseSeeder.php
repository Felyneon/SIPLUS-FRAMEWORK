<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'], // Kunci untuk mencari (agar tidak duplikat)
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Tambahkan password jika diperlukan
            ]
        );
        
        // Jangan lupa panggil seeder ruangan Anda di sini juga jika belum
        $this->call([
            RuanganSeeder::class,
        ]);
    }
}
