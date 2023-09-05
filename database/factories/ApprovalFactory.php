<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\LoanApplication;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $timestamp = null;
        if (!$timestamp) {
            $timestamp = Carbon::now();
        }

        $timestamp = $timestamp->addSeconds(10); // Increase the timestamp by 10 seconds

        return [
            'ApprovalLevelID' => $this->faker->randomElement([1, 2, 3, 4]),
            'LoanApplicationID' => function () {
                // Create a random LoanApplication and return its ID
                $loanApplication = LoanApplication::factory()->create();
                return $loanApplication->LoanApplicationID;
            },
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
