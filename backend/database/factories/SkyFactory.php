<?php

namespace Database\Factories;

use App\Models\SourceNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SourceNews>
 */
class SkyFactory extends Factory
{

    protected $model = SourceNews::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        SourceNews::where('id', '!=', 1)->delete();

        return [
            'id' => 2,
            'source' => 'Sky',
            'link' => 'https://news.sky.com/topic/food-6517',
        ];
    }
}
