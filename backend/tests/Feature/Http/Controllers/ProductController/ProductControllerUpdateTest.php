<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected array $updatedProductData;

    protected function setUp(): void
    {
        parent::setUp();

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
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson("/api/product/{$this->product->id}", $this->updatedProductData);

        $response->assertStatus(200);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('products', $this->updatedProductData);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->putJson("/api/product/{$this->product->id}", $this->updatedProductData);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson("/api/product/{$this->product->id}", $this->updatedProductData);

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::update
     */
    public function it_handles_product_not_found()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson('/api/product/999', $this->updatedProductData);

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
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson("/api/product/{$this->product->id}", []);

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

        $response = $this->putJson("/api/product/{$this->product->id}", []);

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
