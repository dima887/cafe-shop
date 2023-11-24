<?php

namespace Tests\Feature\Http\Controllers\CategoryController;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerIndexTest extends TestCase
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
     * @covers \App\Http\Controllers\CategoryController::index
     */
    public function it_returns_all_categories_with_products()
    {
        $response = $this->get('/api/category');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
                'id',
                'category',
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
     * @covers \App\Http\Controllers\CategoryController::index
     */
    public function it_returns_error_message_and_500_status_on_exception()
    {
        $this->mock(CategoryController::class, function ($mock) {
            $mock->shouldReceive('getAllCategory')->andThrow(new \Exception());
        });

        $response = $this->get('/api/category');

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
