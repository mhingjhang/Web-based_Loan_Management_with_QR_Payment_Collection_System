<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Employee::class;

    public function definition(): array
    {
        return [
            'FirstName' => $this->faker->firstName,
            'MiddleName' => $this->faker->optional()->lastName,  // Using lastName to give it a second word, but this might be adjusted based on your requirements.
            'LastName' => $this->faker->lastName,
            'Email' => $this->faker->unique()->safeEmail,
            'ContactNumber' => $this->faker->numerify('09#########'),  // Generates a random Philippine mobile number
            'Position' => $this->faker->randomElement(['Collector', 'Auditor', 'Credit Investigator', 'Lender']),
            'Status' => $this->faker->randomElement(['Active', 'Inactive']),
            'ProfilePicture' => $this->faker->optional()->imageUrl(), 
            'UserAccountID' => \App\Models\UserAccount::factory(),
        ];
    }

    public function creditInvestigator()
    {
        return $this->state(function (array $attributes) {
            return [
                'Position' => 'Credit Investigator',
            ];
        });
    }
}
