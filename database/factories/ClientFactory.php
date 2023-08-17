<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'FirstName' => $this->faker->firstName,
            'MiddleName' => $this->faker->optional()->lastName,
            'LastName' => $this->faker->lastName,
            'Gender' => $this->faker->randomElement(['male', 'female']),
            'DateOfBirth' => $this->faker->date('Y-m-d', '-18 years'),
            'ContactNumber' => $this->faker->numerify('09#########'),
            'Email' => $this->faker->unique()->safeEmail,
            'Street' => $this->faker->streetAddress,
            'Barangay' => $this->faker->city,
            'City_Municipality' => $this->faker->city,
            'Province' => $this->faker->state,
            'BorrowerPhoto' => $this->faker->optional()->imageUrl(),
            'ValidIDPhoto' => $this->faker->optional()->imageUrl(),
            'Status' => $this->faker->randomElement(['active', 'inactive']),
            'ClientBusinessID' => \App\Models\ClientBusiness::factory(),
            'UserAccountID' => \App\Models\UserAccount::factory(),
            
        ];
    }
}
