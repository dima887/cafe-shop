<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->delete("/api/category/{$this->category->id}");

        $response->assertStatus(200);

        $response->assertJson(['success' => 1]);
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
