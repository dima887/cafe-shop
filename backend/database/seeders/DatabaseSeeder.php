<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use App\Models\Review;
use Database\Factories\AdminFactory;
use Database\Factories\BBCFactory;
use Database\Factories\SkyFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminFactory::new()->create();
        Category::factory(3)->create();
        Product::factory(25)->create();
        Review::factory(30)->create();
        BBCFactory::new()->create();
        SkyFactory::new()->create();
        News::factory(20)->create();
    }
}
