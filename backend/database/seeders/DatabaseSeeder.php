<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\StatusOrder;
use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use App\Models\Review;
use App\Models\TypeOrder;
use App\Models\User;
use Database\Factories\AdminFactory;
use Database\Factories\BBCFactory;
use Database\Factories\SkyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminFactory::new()->create();
        if (!User::find(2)) {
            User::factory()->create([
                'id' => 2,
                'name' => 'user',
                'email' => 'user@mail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
        Category::factory(3)->create();
        Product::factory(25)->create();
        Review::factory(30)->create();
        BBCFactory::new()->create();
        SkyFactory::new()->create();
        News::factory(20)->create();
        if (!StatusOrder::find(1)) {
            StatusOrder::factory()->create(['id' => '1', 'status_order' => 'new order']);
        }
        if (!StatusOrder::find(2)) {
            StatusOrder::factory()->create(['id' => '2', 'status_order' => 'preparing']);
        }
        if (!StatusOrder::find(3)) {
            StatusOrder::factory()->create(['id' => '3', 'status_order' => 'ready']);
        }
        if (!StatusOrder::find(4)) {
            StatusOrder::factory()->create(['id' => '4', 'status_order' => 'closed']);
        }
        if (!StatusOrder::find(5)) {
            StatusOrder::factory()->create(['id' => '5', 'status_order' => 'paid']);
        }
        if (!TypeOrder::find(1)) {
            TypeOrder::factory()->create(['id' => '1', 'type' => 'counter']);
        }
        if (!TypeOrder::find(2)) {
            TypeOrder::factory()->create(['id' => '2', 'type' => 'table']);
        }
        Order::factory(10)->create();
    }
}
