<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAccount;

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
        $borrowerImageUrls = [
            'borrower1.jpg',
            'borrower2.jpg',
            'borrower3.jpg',
            'borrower4.jpg',
            'borrower5.jpg',
            'borrower6.jpg',
            'borrower7.jpg',
            'borrower8.jpg',
            'borrower9.jpg',
            'borrower10.jpg',
            // Add more image URLs as needed
        ];

        $validIDImageUrls = [
            'validID1.jpg',
            'validID2.jpg',
            'validID3.png',
            'validID4.png',
            'validID5.jpeg',
            'validID6.jpg',
            'validID7.jpg',
            'validID8.jpg',
            'validID9.jpg',
            'validID10.jpg',
            // Add more image URLs as needed
        ];

        return [
            'FirstName' => $this->faker->firstName,
            'MiddleName' => $this->faker->optional()->lastName,
            'LastName' => $this->faker->lastName,
            'Gender' => $this->faker->randomElement(['Male', 'Female']),
            'DateOfBirth' => $this->faker->date('Y-m-d', '-18 years'),
            'ContactNumber' => $this->faker->numerify('09#########'),
            'Email' => $this->faker->unique()->safeEmail,
            'Street' => $this->faker->streetAddress,
            'Barangay' => $this->faker->city,
            'City_Municipality' => $this->faker->city,
            'Province' => $this->faker->state,
            'BorrowerPhoto' => $this->faker->randomElement($borrowerImageUrls),
            'ValidIDPhoto' => $this->faker->randomElement($validIDImageUrls),
            'Status' => $this->faker->randomElement(['Active', 'Inactive']),
            'ClientBusinessID' => \App\Models\ClientBusiness::factory(),
            'UserAccountID' => \App\Models\UserAccount::factory(),
            
        ];
    }

}
