<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create(['parent_id' => null, 'type' => 'manufacturer']);
        Category::factory()->count(20)->create([
            'parent_id' => fn() => Category::all()->whereNull('parent_id')->random()->id,
            'type' => 'model'
        ]);
        Category::factory()->count(20)->create([
            'parent_id' => fn() => Category::all()->whereNull('parent_id')->random()->id,
            'type' => 'part'
        ]);

    }
}
