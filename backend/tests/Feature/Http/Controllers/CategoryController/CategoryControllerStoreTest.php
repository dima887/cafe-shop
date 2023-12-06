<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->data = [
            'category' => $this->category->category,
            'description' => $this->category->description,
            'thumbnail' => $this->category->thumbnail,
        ];
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_creates_category_successfully()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/category', $this->data);

        $response->assertStatus(201);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', $this->data);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->postJson('/api/category', $this->data);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/category', $this->data);

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_returns_validation_error()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/category', []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => [
                'category',
            ],
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_returns_500_for_unexpected_problems()
    {
        $this->mock(CategoryController::class, function ($mock) {
            $mock->shouldReceive('create')->andThrow(new \Exception());
        });

        $response = $this->postJson('/api/category', ['category' => $this->category->category]);

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }

}
