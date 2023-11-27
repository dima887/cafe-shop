<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->put("/api/category/{$this->category->id}", $this->updatedCategoryData);

        $response->assertStatus(200);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', $this->updatedCategoryData);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::update
     */
    public function it_returns_404_for_nonexistent_category()
    {
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
