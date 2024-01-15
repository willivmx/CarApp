<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class carFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'year' => fake()->year(),
            'plate_number' => fake()->word(),
            'color' => fake()->colorName(),
            'fuel_type' => fake()->randomElement(['gasoline', 'diesel', 'electric']),
            'mileage' => fake()->numberBetween(0, 100000),
            'status' => fake()->randomElement(['available', 'unavailable'])
        ];
    }
}
