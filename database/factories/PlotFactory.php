<?php

namespace Database\Factories;

use App\Models\Plot;
use App\Models\Farm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plot>
 */
class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farm_id' => Farm::query()->inRandomOrder()->value('id') ?? 1,
            'name' => 'Lote ' . fake()->bothify('??-###'),
            'area_hectares' => fake()->randomFloat(2, 0.1, 50),
            'status' => fake()->randomElement(['Disponible', 'Sembrado', 'En descanso', 'Cosechado']),
        ];
    }
}
