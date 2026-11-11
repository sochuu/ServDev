<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Article> */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $images = [
            ['preview.jpg', 'full.jpeg'],
            ['preview_2.jpg', 'full_2.jpeg'],
        ];

        [$preview, $full] = fake()->randomElement($images);

        return [
            'date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'name' => fake()->sentence(6),
            'preview_image' => $preview,
            'full_image' => $full,
            'short_desc' => fake()->sentence(12),
            'desc' => fake()->paragraphs(3, true),
        ];
    }
}
