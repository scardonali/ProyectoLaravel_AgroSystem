<?php

namespace Database\Factories;

use App\Models\Crop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Crop>
 */
class CropFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Maíz', 'Arroz', 'Papa', 'Café']),
            'variety' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
