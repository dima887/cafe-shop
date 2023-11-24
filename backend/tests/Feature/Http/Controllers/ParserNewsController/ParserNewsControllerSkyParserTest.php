<?php

namespace Tests\Feature\Http\Controllers\ParserNewsController;

use App\Http\Controllers\ParserNewsController;
use Database\Factories\BBCFactory;
use Database\Factories\SkyFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ParserNewsControllerSkyParserTest extends TestCase
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
     * @covers \App\Http\Controllers\ParserNewsController::skyParse
     */
    public function it_parses_and_saves_news_successfully()
    {
        $response = $this->post('/api/parse-news-sky');

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\ParserNewsController::skyParse
     */
    public function it_handles_parsing_or_saving_error()
    {
        $this->mock(ParserNewsController::class, function ($mock) {
            $mock->shouldReceive('parseNews')->withAnyArgs()->andThrow(new \Exception('Oops, there are temporary problems'));
        });

        $response = $this->post('/api/parse-news-sky');

        $response->assertStatus(500);

        $response->assertJson([
            'error' => 'Oops, there are temporary problems',
        ]);
    }
}
