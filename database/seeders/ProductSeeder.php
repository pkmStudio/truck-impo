<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Catalog;
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
        Product::factory()->count(40)->create();
    }
}
