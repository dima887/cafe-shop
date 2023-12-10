<?php

namespace Database\Factories;

use App\Models\TypeOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeOrder>
 */
class TypeOrderFactory extends Factory
{
    protected $model = TypeOrder::class;

    /**
     * Define the model's default state.
     * @return array
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word,
        ];
    }
}
