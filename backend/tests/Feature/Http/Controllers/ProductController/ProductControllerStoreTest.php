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

class ProductControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    protected array $productData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create(['category_id' => $this->category->id]);

        $this->productData = [
            'name' => $this->product->name,
            'description' => $this->product->description,
            'price' => $this->product->price,
            'thumbnail' => $this->product->thumbnail,
            'category_id' => $this->category->id,
        ];

    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::store
     */
    public function it_creates_product_successfully()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/product', $this->productData);

        $response->assertStatus(201);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('products', $this->productData);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::store
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->post('/api/product', $this->productData);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::store
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/product', $this->productData);

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::store
     */
    public function it_handles_validation_error()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/product', []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => [
                'name',
            ],
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::store
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(ProductController::class, function ($mock) {
            $mock->shouldReceive('create')->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->post('/api/product', $this->productData);

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
