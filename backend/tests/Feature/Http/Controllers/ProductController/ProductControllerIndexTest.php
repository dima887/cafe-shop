<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerIndexTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        AdminFactory::new()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create(['category_id' => $this->category->id]);
        $this->reviews = Review::factory()->create(['product_id' => $this->product->id]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::index
     */
    public function it_returns_all_products_with_categories_and_reviews()
    {
        $response = $this->get('/api/product');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
                'id',
                'name',
                'description',
                'price',
                'thumbnail',
                'sold_count',
                'category_id',
                'category' => [
                    'id',
                    'category'
                ],
                'reviews' => [
                    '*' => [
                        'id',
                        'review',
                        'user_id',
                        'product_id'
                    ]
                ],
            ]
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::index
     */
    public function it_returns_error_message_and_500_status_on_exception()
    {
        $this->mock(ProductController::class, function ($mock) {
            $mock->shouldReceive('getAllProduct')->andThrow(new \Exception());
        });

        $response = $this->get('/api/product');

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
