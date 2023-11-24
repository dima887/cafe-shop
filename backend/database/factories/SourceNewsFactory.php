<?php

namespace Database\Factories;

use App\Models\SourceNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SourceNews>
 */
class SourceNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => $this->faker->word,
            'link' => $this->faker->imageUrl(),
        ];
    }
}
