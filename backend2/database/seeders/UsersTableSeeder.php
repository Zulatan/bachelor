<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mikkel',
                'email' => 'mikkel@example.com',
                'password' => Hash::make('mikkel'),
                'worker' => false,
                'customer' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Worker',
                'email' => 'worker@example.com',
                'password' => Hash::make('worker'),
                'worker' => true,
                'customer' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
