<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAccount>
 */
class UserAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\UserAccount::class;

    public function definition(): array
    {
        return [
            'UserName' => $this->faker->unique()->userName,  
            'Password' => bcrypt($this->faker->password), 
            'DateCreated' => now(),     
            'Status' => $this->faker->randomElement(['Active', 'Inactive']), 
        ];
    }

}
