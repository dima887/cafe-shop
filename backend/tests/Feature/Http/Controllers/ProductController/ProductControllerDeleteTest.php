<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductControllerDeleteTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create(['category_id' => $this->category->id]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::delete
     */
    public function it_deletes_product_successfully()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

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
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->delete("/api/product/{$this->product->id}");

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ProductController::delete
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->delete("/api/product/{$this->product->id}");

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
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
