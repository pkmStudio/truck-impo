<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'description' => fake()->text,
            'content' => fake()->randomHtml(2,5),
            'image_path' => fake()->imageUrl,
            'slug' => fake()->unique()->slug,
        ];
    }
}
