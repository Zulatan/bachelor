<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bookings;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bookings::create([
            'customer' => 1, // Replace with an existing user ID
            'admin' => 2,    // Replace with an existing admin ID
            'bookingTime' => now(),
            'accepted' => true,
            'status' => 'confirmed',
        ]);

        Bookings::create([
            'customer' => 3, // Replace with another existing user ID
            'admin' => 2,
            'bookingTime' => now()->addDay(),
            'accepted' => false,
            'status' => 'pending',
        ]);
    }
}
