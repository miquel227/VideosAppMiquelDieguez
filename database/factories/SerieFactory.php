<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SerieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'          => $this->faker->sentence(3),
            'description'    => $this->faker->paragraph(),
            'image'          => null,
            'user_name'      => $this->faker->name(),
            'user_photo_url' => null,
            'published_at'   => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
