<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StatusOrder;
use App\Models\TypeOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $typeOrder = TypeOrder::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $status_order = StatusOrder::inRandomOrder()->first();

        return [
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'type_order_id' => $typeOrder->id,
            'user_id' => $user->id,
            'status_order_id' => $status_order->id,
        ];
    }
}
