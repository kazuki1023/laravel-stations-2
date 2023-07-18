<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'published_year' => $this->faker->year(),
            'is_showing' => $this->faker->boolean(),
            'description' => $this->faker->text(10),
        ];
    }
}
