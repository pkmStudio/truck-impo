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
            'meta_h1' => $this->faker->words(3, true),
            'meta_title' => $this->faker->words(3, true),
            'meta_description' => $this->faker->words(3, true),
            'metatagable_id' => null,
            'metatagable_type' => null,
        ];
    }
}
