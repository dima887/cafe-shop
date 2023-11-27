<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerShowTest extends TestCase
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
     * @covers \App\Http\Controllers\ProductController::show
     */
    public function it_returns_product_by_id()
    {
        $response = $this->get('/api/product/' . $this->product->id);

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
     * @covers \App\Http\Controllers\ProductController::show
     */
    public function it_returns_404_for_nonexistent_product()
    {
        $response = $this->get('/api/product/999');

        $response->assertStatus(404);

        $response->assertJson([
            'error' => 'Product not found',
        ]);
    }
    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::show
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(ProductController::class, function ($mock) {
            $mock->shouldReceive('getProductById')->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->get('/api/product/' . $this->product->id);

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
