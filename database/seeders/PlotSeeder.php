<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plot;
use App\Models\Farm;

class PlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farms = Farm::all();
        foreach ($farms as $farm) {
            Plot::factory()->count(rand(3, 7))->create(['farm_id' => $farm->id]);
        }
    }
}
