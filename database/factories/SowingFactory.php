<?php

namespace Database\Factories;

use App\Models\Sowing;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Crop; 

/**
 * @extends Factory<Sowing>
 */
class SowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'crop_id' => Crop::factory(), 
            'sowing_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Sembrado', 'En crecimiento', 'Cosechado']),
        ];
    }
}
