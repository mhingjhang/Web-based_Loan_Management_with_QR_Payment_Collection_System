<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientBusiness>
 */
class ClientBusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'BusinessName' => $this->faker->company,
            'AverageDailyIncome' => $this->faker->randomFloat(2, 100, 10000),
            'TypeOfBusiness' => $this->faker->randomElement(['retail', 'wholesale', 'service', 'manufacturing']),
            'Street' => $this->faker->streetAddress,
            'Barangay' => $this->faker->city,
            'City_Municipality' => $this->faker->city,
            'Province' => $this->faker->state,
            'EstablishmentPhoto' => $this->faker->optional()->imageUrl(),
            'BusinessPermitPhoto' => $this->faker->optional()->imageUrl(),
            'Status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
