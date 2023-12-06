<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected array $updatedCategoryData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();

        $this->updatedCategoryData = [
            'category' => 'Updated Category',
            'description' => 'Updated Description',
            'thumbnail' => 'Updated Thumbnail',
        ];
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_updates_category_successfully()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->put("/api/category/{$this->category->id}", $this->updatedCategoryData);

        $response->assertStatus(200);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', $this->updatedCategoryData);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->put("/api/category/{$this->category->id}", $this->updatedCategoryData);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->put("/api/category/{$this->category->id}", $this->updatedCategoryData);

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_404_for_nonexistent_category()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson('/api/category/999', $this->updatedCategoryData);

        $response->assertStatus(404);

        $response->assertJson(['error' => 'Category not found']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_validation_error()
    {
        $user = AdminFactory::new()->create();
        Sanctum::actingAs($user);
        $user->createToken('test-token')->plainTextToken;

        $response = $this->put("/api/category/{$this->category->id}", []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => [
                'category',
            ],
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_500_for_unexpected_problems()
    {
        $this->mock(CategoryController::class, function ($mock) {
            $mock->shouldReceive('update')->andThrow(new \Exception());
        });

        $response = $this->put("/api/category/{$this->category->id}", $this->updatedCategoryData);

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
