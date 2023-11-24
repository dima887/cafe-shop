<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_creates_category_successfully()
    {
        $data = ['category' => $this->category->category];

        $response = $this->post('/api/category', $data);

        $response->assertStatus(201);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::store
     */
    public function it_returns_validation_error()
    {
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

        $response = $this->post('/api/category', ['category' => $this->category->category]);

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }

}
