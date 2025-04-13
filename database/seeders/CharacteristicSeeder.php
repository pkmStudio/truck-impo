<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharacteristicSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Characteristic::factory()->count(40)->create([
            'product_id' => Product::all()->random()->first()->id,
        ]);
    }
}
