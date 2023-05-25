<?php

namespace Database\Seeders;

use App\Models\ReservationConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReservationConfig::create([
            'capacity' => 50,
            'max_reservation_per_day' => 5,
        ]);
    }
}
