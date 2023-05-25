<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Ibnu',
            'last_name' => 'Sutio',
            'fullname' => 'Ibnu Sutio',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 2,
        ]);
    }
}
