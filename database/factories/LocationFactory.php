<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locations>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'car_id' => fake()->numberBetween(1, 10),
            'location_date' => fake()->dateTimeBetween('-1 years', 'now'),
            'return_date' => fake()->dateTimeBetween('now', '+1 years'),
            'location_amount' => fake()->numberBetween(0, 100000),
            'status' => fake()->randomElement(['initiated', 'in progress', 'returned', 'cancelled']),
            'comment' => fake()->sentence()
        ];
    }
}
