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
            'status' => fake()->randomElement(['available', 'unavailable']),
            'cover' => fake()->randomElement([
                "https://images.unsplash.com/photo-1545061371-98a8355c9c0d?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjcxNzd8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1588258219511-64eb629cb833?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjcyOTF8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1611016186353-9af58c69a533?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczMDd8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1571607388263-1044f9ea01dd?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczMjV8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1534093607318-f025413f49cb?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczNDJ8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1608134021189-985922ce9643?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczNTd8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1619405399517-d7fce0f13302?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczNzB8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1489686995744-f47e995ffe61?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczODZ8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1611858246382-da4877c6476d?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4NjczOTh8&ixlib=rb-4.0.3",
                "https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixid=M3w0OTkyNDR8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDU4Njc0MTB8&ixlib=rb-4.0.3"
            ]),
        ];
    }
}
