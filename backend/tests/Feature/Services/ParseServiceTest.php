<?php

namespace Tests\Feature\Services;

use App\Enums\SourceNews;
use App\Factories\ParserNews\ParserNewsFactory;
use App\Services\ParseService;
use Database\Factories\BBCFactory;
use Database\Factories\SkyFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class ParseServiceTest extends TestCase
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
     * @throws Exception
     * @covers \App\Services\ParseService::parseNews
     */
    public function testParseNews()
    {
        $parserNewsFactoryMock = $this->createMock(ParserNewsFactory::class);
        $parserNewsFactoryMock->expects($this->once())->method('getParse')->willReturn([
            [
                'thumbnail' => '...',
                'header' => '...',
                'content' => '...',
                'source_news_id' => SourceNews::BBC->value
            ]
        ]);

        $sourceId = SourceNews::BBC->value;
        $parseService = new ParseService();
        $result = $parseService->parseNews($parserNewsFactoryMock, $sourceId);

        $this->assertTrue($result);

        $this->assertDatabaseHas('news', ['source_news_id' => $sourceId]);
    }

    /**
     * @test
     * @covers \App\Services\ParseService::deleteBySourceId
     */
    public function testDeleteBySourceId()
    {
        $sourceIdToDelete = SourceNews::BBC->value;
        $parseService = new ParseService();
        $parseService->deleteBySourceId($sourceIdToDelete);

        $this->assertDatabaseMissing('news', ['source_news_id' => $sourceIdToDelete]);
    }
}
