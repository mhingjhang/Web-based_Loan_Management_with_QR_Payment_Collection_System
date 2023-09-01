<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'PaymentDate' => $this->faker->dateTimeBetween('2023-07-29', '2023-07-31')->format('Y-m-d'),
            'PaymentAmount' => $this->faker->randomFloat(2, 100, 1000),
            'PrincipalEarned' => $this->faker->randomFloat(2, 50, 500),
            'InterestEarned' => $this->faker->randomFloat(2, 10, 100),
            'PaymentMethod' => $this->faker->randomElement(['Cash', 'Credit Card', 'Bank Transfer']),
            'Void' => $this->faker->randomElement(['Yes', 'No']),
            'LoanID' => $this->faker->randomElement([1, 3, 4]), // Replace with actual range of LoanIDs
            'EmployeeID' => $this->faker->randomElement([3, 4, 5, 10]), // Replace with actual range of EmployeeIDs
        ];
    }
}
