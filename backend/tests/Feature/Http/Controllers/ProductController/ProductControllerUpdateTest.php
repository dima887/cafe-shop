<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected array $updatedProductData;

    protected function setUp(): void
    {
        parent::setUp();

        AdminFactory::new()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create(['category_id' => $this->category->id]);

        $this->updatedProductData = [
            'name' => 'Updated Product',
            'description' => 'Updated description of the product',
            'price' => 29.99,
            'thumbnail' => 'path/to/updated-thumbnail.jpg',
            'category_id' => $this->category->id,
        ];

    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_updates_product_successfully()
    {
        $response = $this->put("/api/product/{$this->product->id}", $this->updatedProductData);

        $response->assertStatus(200);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('products', $this->updatedProductData);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_handles_product_not_found()
    {
        $response = $this->put('/api/product/999', $this->updatedProductData);

        $response->assertStatus(404);

        $response->assertJson([
            'error' => 'Product not found',
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_handles_validation_error()
    {
        $response = $this->put("/api/product/{$this->product->id}", []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => [
                'name',
            ],
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(ProductController::class, function ($mock) {
            $mock->shouldReceive('update')->withAnyArgs()->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->put("/api/product/{$this->product->id}", []);

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
