<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory()->count(40)->create([
            'brand_id' => fn() => Brand::all()->random()->id,
            'category_id' => fn() => Category::all()->random()->id
        ]);
    }
}
