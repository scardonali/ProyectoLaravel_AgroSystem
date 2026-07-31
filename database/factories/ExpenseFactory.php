<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sowing;
use App\Models\Supply;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
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
        'supply_id' => Supply::inRandomOrder()->first()->id,
        'quantity_used' => fake()->numberBetween(1, 50),
        'total_cost' => fake()->numberBetween(1000, 50000),
        'date' => fake()->date(),
        'description' => fake()->sentence(),
        ];
    }
}
