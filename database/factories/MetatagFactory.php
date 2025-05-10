<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Metatag>
 */
class MetatagFactory extends Factory
{

    public function definition()
    {
        return [
            'meta_h1' => $this->faker->sentence,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'metatagable_id' => null,
            'metatagable_type' => null,
        ];
    }
}
