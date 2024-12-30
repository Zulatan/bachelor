<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bookings;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            BookingsTableSeeder::class,
            ServicesSeeder::class,
        ]);

    }
}



