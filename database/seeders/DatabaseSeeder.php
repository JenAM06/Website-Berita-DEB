<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin
        User::create([
            'name'     => 'Admin EcoBetapus',
            'email'    => 'admin@ecobetapus.id',
            'password' => bcrypt('password123'),
        ]);

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}