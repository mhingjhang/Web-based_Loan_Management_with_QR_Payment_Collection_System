<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\LoanApplication::class;

    public function definition(): array
    {
        return [
            'ApplicationDate' => $this->faker->date(),
            'Principal' => $this->faker->randomFloat(2, 1000, 50000),
            'DurationDays' => $this->faker->numberBetween(30, 365),
            'DurationMonths' => $this->faker->numberBetween(1, 12),
            'Interest' => $this->faker->randomFloat(2, 100, 10000),
            'InterestRate' => $this->faker->randomFloat(2, 1, 30),
            'TotalAmountDue' => $this->faker->randomFloat(2, 1000, 60000),
            'DailyRepayment' => $this->faker->randomFloat(2, 10, 500),
            'ServiceFee' => $this->faker->randomFloat(2, 10, 1000),
            'Status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'ClientID' => \App\Models\Client::factory(), // Assuming clients table has at least 100 records
            'EmployeeID' => \App\Models\Employee::factory(),
        ];
    }
}
