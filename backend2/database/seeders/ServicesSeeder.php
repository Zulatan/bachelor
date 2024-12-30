<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['name'      => 'Hårklip'],
            ['name'      => 'Hår vask'],
            ['name'      => 'Hårfarvning'],
            ['name'      => 'Skægtrimning'],
        ]);
    }
}
