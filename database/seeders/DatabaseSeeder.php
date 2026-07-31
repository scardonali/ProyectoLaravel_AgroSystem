<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FarmSeeder::class,
            PlotSeeder::class,
            SupplySeeder::class,
            CropSeeder::class,   
            SowingSeeder::class, 
            HarvestSeeder::class, 
            ExpenseSeeder::class, 
        ]);
    }
}