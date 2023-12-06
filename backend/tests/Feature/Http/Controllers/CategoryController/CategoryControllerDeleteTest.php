<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryControllerDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::delete
     */
    public function it_deletes_category_successfully()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->delete("/api/category/{$this->category->id}");

        $response->assertStatus(200);

        $response->assertJson(['success' => 1]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::delete
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->delete("/api/category/{$this->category->id}");

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::delete
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->delete("/api/category/{$this->category->id}");

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::delete
     */
    public function it_returns_500_for_unexpected_problems()
    {
        $this->mock(CategoryController::class, function ($mock) {
            $mock->shouldReceive('delete')->andThrow(new \Exception());
        });

        $response = $this->delete("/api/category/{$this->category->id}");

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
