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
            'content' => '{
    "first-section": "<header><h1>Категория: Запчасти для BMW</h1></header>",
    "second-section": "<section><p>Здесь вы найдете все запчасти для автомобилей BMW, включая тормоза, диски и масла.</p></section>",
    "third-section": "<footer><p>© 2025 Все права защищены. Свяжитесь с нами для консультации.</p></footer>"
}',
            'image_path' => fake()->imageUrl,
            'slug' => fake()->unique()->slug,
        ];
    }
}
