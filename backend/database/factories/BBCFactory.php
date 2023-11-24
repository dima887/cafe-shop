<?php

namespace Database\Factories;

use App\Models\SourceNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SourceNews>
 */
class BBCFactory extends Factory
{

    protected $model = SourceNews::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        SourceNews::where('id', '!=', 2)->delete();
        return [
            'id' => 1,
            'source' => 'BBC',
            'link' => 'https://www.bbc.co.uk/news/topics/cp7r8vglgq1t',
        ];
    }
}
