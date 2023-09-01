<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollectorSite>
 */
class CollectorSiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\CollectorSite::class;

    public function definition(): array
    {
        
        return [
            'AreaID' => rand(1, 4),
            'EmployeeID' => \App\Models\Employee::factory(),
        ];
    }
}
