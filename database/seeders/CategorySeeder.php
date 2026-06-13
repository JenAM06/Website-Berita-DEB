<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Energi',
                'slug' => 'energi',
                'description' => 'Berita seputar energi terbarukan, PLTS, dan kemandirian energi kawasan Betapus.',
            ],
            [
                'name' => 'Lingkungan',
                'slug' => 'lingkungan',
                'description' => 'Informasi tentang bank sampah, budidaya maggot, dan pengelolaan lingkungan.',
            ],
            [
                'name' => 'Edukasi',
                'slug' => 'edukasi',
                'description' => 'Program edukasi masyarakat, goes to school, dan pelatihan lingkungan.',
            ],
            [
                'name' => 'Ekonomi',
                'slug' => 'ekonomi',
                'description' => 'Pemberdayaan UMKM, budidaya maggot sebagai ekonomi sirkular.',
            ],
            [
                'name' => 'Wisata',
                'slug' => 'wisata',
                'description' => 'Eco-tourism kawasan Sawah Betapus dan destinasi wisata berkelanjutan.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}