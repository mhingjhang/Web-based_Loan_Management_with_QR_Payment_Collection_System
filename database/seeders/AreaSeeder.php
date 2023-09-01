<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            ['Area' => 'Koronadal'],
            ['Area' => 'Surallah'],
            ['Area' => 'Norallah'],
            ['Area' => 'Sultan Kudarat'],
        ]);
    }
}
