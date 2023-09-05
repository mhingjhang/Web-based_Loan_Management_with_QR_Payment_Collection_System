<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

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
        $creditInvestigator = Employee::factory()->creditInvestigator()->create();

        return [
            'ApplicationDate' => $this->faker->date(),
            'Principal' => $this->faker->randomElement([5000, 10000]),
            'DurationDays' => 60,
            'DurationMonths' => 2,
            'Status' => $this->faker->randomElement(['Pending', 'Rejected']),
            'ClientID' => \App\Models\Client::factory(), // Assuming clients table has at least 100 records
            'EmployeeID' => $creditInvestigator->EmployeeID,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (\App\Models\LoanApplication $loanApplication) {
            // Set a fixed interest rate of 10%
            $loanApplication->InterestRate = 0.10;
            
            // Calculate the Interest based on Principal and fixed InterestRate
            $loanApplication->Interest = $loanApplication->Principal * ($loanApplication->InterestRate * $loanApplication->DurationMonths);

            // Calculate the TotalAmountDue as the sum of Principal and Interest
            $loanApplication->TotalAmountDue = $loanApplication->Principal + $loanApplication->Interest;

            $loanApplication->DailyRepayment = $loanApplication->TotalAmountDue / $loanApplication->DurationDays;

            $loanApplication->ServiceFee = $loanApplication->Principal * 0.011;
        });
    }
}
