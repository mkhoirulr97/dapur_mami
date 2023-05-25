<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'Dapur Mami',
            'address' => 'Jl. Anggrek, Logandang Barat, Talkandang, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68315',
            'phone' => '0895-2406-4232',
            'bank_name' => 'BRI',
            'bank_account' => '1234567890',
            'bank_account_name' => 'Dapur Mami',
            'open_at' => '16:00:00',
            'close_at' => '22:00:00',
        ]);
    }
}
