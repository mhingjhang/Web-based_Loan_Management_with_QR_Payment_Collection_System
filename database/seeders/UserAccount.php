<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_accounts')->insert([
            'UserName' => 'mhing',
            'Password' => Hash::make('123'),
            'DateCreated' => now(),
            'Status' => 'Active',
             // Hash the password
]);
    }
}
