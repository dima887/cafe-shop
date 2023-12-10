<?php

namespace Database\Factories;

use App\Models\StatusOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StatusOrderFactory extends Factory
{
    protected $model = StatusOrder::class;

    /**
     * Define the model's default state.
     * @return array
     */
    public function definition(): array
    {
        return [
            'status_order' => $this->faker->word,
        ];
    }
}
