<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remittance>
 */
class RemittanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'RemittanceDate' => $this->faker->dateTimeBetween('2023-07-29', '2023-07-31')->format('Y-m-d'),
            'RemittanceAmount' => $this->faker->randomFloat(2, 100, 1000),
            'EmployeeID' => $this->faker->randomElement([3, 4, 5, 10]), // Replace with actual range of EmployeeIDs
        ];
    }
}
