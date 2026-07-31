<?php

namespace Database\Factories;

use App\Models\Harvest;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sowing;
/**
 * @extends Factory<Harvest>
 */
class HarvestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'sowing_id' => Sowing::inRandomOrder()->first()->id,
        'quantity' => fake()->numberBetween(10, 500),
        'unit' => 'kg',
        'sale_price' => fake()->numberBetween(5000, 100000),
        'date' => fake()->date(),
        ];
    }
}
