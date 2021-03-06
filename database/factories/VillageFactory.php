<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VillageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->streetName();
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug
        ];
    }
}
