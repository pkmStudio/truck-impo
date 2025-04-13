<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article' => fake()->unique()->randomNumber(),
            'title' => fake()->title,
            'description' => fake()->text,
            'price' => fake()->realTextBetween(5, 10),
            'delivery' => fake()->realTextBetween(5, 10),
            'quantity' => fake()->numberBetween(0, 1000),
            'image_path' => fake()->imageUrl,
            'slug' => fake()->unique()->slug,
        ];
    }
}
