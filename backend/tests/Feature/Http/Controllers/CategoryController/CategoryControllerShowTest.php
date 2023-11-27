<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->products = Product::factory()->count(2)->create(['category_id' => $this->category->id]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::show
     */
    public function it_returns_category()
    {
        $response = $this->get("/api/category/{$this->category->id}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
                'id',
                'category',
                'description',
                'thumbnail',
                'products' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'price',
                        'thumbnail',
                        'sold_count',
                        'category_id',
                    ],
                ],
            ]
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::show
     */
    public function it_returns_404_for_nonexistent_category()
    {
        $response = $this->get('/api/category/999');

        $response->assertStatus(404);

        $response->assertJson(['error' => 'Category not found']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CategoryController::show
     */
    public function it_returns_500_for_unexpected_problems()
    {
        $this->mock(CategoryController::class, function ($mock) {
            $mock->shouldReceive('getCategoryById')->andThrow(new \Exception());
        });

        $response = $this->get('/api/category/1');
        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
