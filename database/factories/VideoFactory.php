<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(4),
            'description'  => $this->faker->paragraph(),
            'url'          => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'previous'     => null,
            'next'         => null,
            'series_id'    => null,
        ];
    }
}
