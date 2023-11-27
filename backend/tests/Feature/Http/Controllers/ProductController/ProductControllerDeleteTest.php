<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerDeleteTest extends TestCase
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
     * @covers \App\Http\Controllers\ProductController::delete
     */
    public function it_deletes_product_successfully()
    {
        $response = $this->delete("/api/product/{$this->product->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'success' => 1,
        ]);

        $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::delete
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(ProductController::class, function ($mock) {
            $mock->shouldReceive('delete')->withAnyArgs()->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->delete("/api/product/{$this->product->id}");

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
