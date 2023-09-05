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
        $establishmentImageUrls = [
            'establishment1.jpg',
            'establishment2.jpg',
            'establishment3.jpg',
            'establishment4.jpg',
            'establishment5.jpg',
        ];

        $permitImageUrls = [
            'permit1.jpg',
            'permit2.jpg',
            'permit3.jpg',
            'permit4.jpg',
            'permit5.jpg',
        ];

        return [
            'BusinessName' => $this->faker->company,
            'AverageDailyIncome' => $this->faker->randomFloat(2, 100, 10000),
            'TypeOfBusiness' => $this->faker->randomElement(['Retail', 'Wholesale', 'Service', 'Manufacturing']),
            'Street' => $this->faker->streetAddress,
            'Barangay' => $this->faker->city,
            'City_Municipality' => $this->faker->city,
            'Province' => $this->faker->state,
            'EstablishmentPhoto' => $this->faker->randomElement($establishmentImageUrls),
            'BusinessPermitPhoto' => $this->faker->randomElement($permitImageUrls),
            'Status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
