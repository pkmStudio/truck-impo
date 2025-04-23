<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manufacturer_id' => Manufacturer::all()->random()->id,
            'title' => fake()->unique()->word(),
            'description' => fake()->text,
            'content' => fake()->randomHtml(2,5),
            'image_path' => fake()->imageUrl,
            'slug' => fake()->slug,
        ];
    }
}
