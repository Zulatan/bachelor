<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bookings;

class BookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        Bookings::create([
            'user_id'           => 1,
            'scheduled_time'    => now(),
            // 'accepted'          => true,
            'status'            => 'pending',
        ]);
    }
}
