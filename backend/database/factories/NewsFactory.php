<?php

namespace Database\Factories;

use App\Models\SourceNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $source_news = SourceNews::inRandomOrder()->first();
        return [
            'header' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(),
            'source_news_id' => $source_news->id,
        ];
    }
}
