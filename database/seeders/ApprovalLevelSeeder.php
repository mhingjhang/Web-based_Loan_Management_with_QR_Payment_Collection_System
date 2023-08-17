<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ApprovalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('approval_levels')->insert([
            ['ApprovalLevel' => 'Borrower and Income Evaluation'],
            ['ApprovalLevel' => 'Payment History Evaluation'],
            ['ApprovalLevel' => 'Credit Investigator Approval'],
            ['ApprovalLevel' => 'Disbursement Approval'],
        ]);
    }
}
