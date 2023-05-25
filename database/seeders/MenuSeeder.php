<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng',
                'price' => 10000,
                'category' => 1,
                'description' => 'Nasi goreng dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Nasi Goreng Spesial',
                'price' => 15000,
                'category' => 1,
                'description' => 'Nasi goreng dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Soto Ayam',
                'price' => 10000,
                'category' => 1,
                'description' => 'Soto ayam dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            // minuman
            [
                'name' => 'Es Teh',
                'price' => 5000,
                'category' => 2,
                'description' => 'Es teh dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Es Jeruk',
                'price' => 5000,
                'category' => 2,
                'description' => 'Es jeruk dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Es Campur',
                'price' => 10000,
                'category' => 2,
                'description' => 'Es campur dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            // camilan
            [
                'name' => 'Keripik',
                'price' => 5000,
                'category' => 3,
                'description' => 'Keripik dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Keripik Kacang',
                'price' => 5000,
                'category' => 3,
                'description' => 'Keripik kacang dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
            [
                'name' => 'Keripik Tempe',
                'price' => 5000,
                'category' => 3,
                'description' => 'Keripik tempe dengan bumbu khas Indonesia',
                'weight' => 100,
            ],
        ];

        Menu::insert($menus);
    }
}
