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
        $categories = Category::all()->whereNotNull('parent_id');

        Product::factory()->count(40)->create([
            'brand_id' => fn() => Brand::all()->random()->id,
        ]);

        $products = Product::all();

        foreach ($products as $product) {
            $categoryIds = $categories->random(rand(1, 5))->pluck('id');
            $product->categories()->syncWithoutDetaching($categoryIds);
        }


    }
}
