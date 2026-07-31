<?php

namespace Database\Factories;

use App\Models\Supply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supply>
 */
class SupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->randomElement(['Fertilizante', 'Semilla', 'Insecticida']),
        'type' => fake()->randomElement(['Químico', 'Orgánico']),
        'unit_of_measure' => fake()->randomElement(['kg', 'litros']),
        'current_stock' => fake()->numberBetween(10, 500),
        'minimum_stock' => fake()->numberBetween(1, 50),
        'unit_price' => fake()->numberBetween(1000, 50000),
        ];
    }
}
