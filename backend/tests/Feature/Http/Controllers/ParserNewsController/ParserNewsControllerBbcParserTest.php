<?php

namespace Tests\Feature\Http\Controllers\ParserNewsController;

use App\Http\Controllers\ParserNewsController;
use App\Models\User;
use Database\Factories\AdminFactory;
use Database\Factories\BBCFactory;
use Database\Factories\SkyFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ParserNewsControllerBbcParserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        BBCFactory::new()->create();
        SkyFactory::new()->create();

    }

    /**
     * @test
     * @covers \App\Http\Controllers\ParserNewsController::bbcParse
     */
    public function it_parses_and_saves_news_successfully()
    {
        $user = AdminFactory::new()->create();
        Sanctum::actingAs($user);
        $user->createToken('test-token')->plainTextToken;

        $response = $this->post('/api/parse-news-bbc');

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ParserNewsController::bbcParse
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->post('/api/parse-news-bbc');

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ParserNewsController::bbcParse
     */
    public function it_returns_403_if_forbidden()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/parse-news-bbc');

        $response->assertStatus(403);

        $response->assertJson(['error' => 'Forbidden.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ParserNewsController::bbcParse
     */
    public function it_handles_parsing_or_saving_error()
    {
        $this->mock(ParserNewsController::class, function ($mock) {
            $mock->shouldReceive('parseNews')->withAnyArgs()->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->post('/api/parse-news-bbc');

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
