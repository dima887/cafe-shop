<?php

namespace Tests\Unit\Parsers\ParserNews;

use App\Parsers\ParserNews\SkyParser;
use Mockery;
use PHPUnit\Framework\TestCase;

class SkyParserTest extends TestCase
{

    /**
     * @test
     * @covers \App\Parsers\ParserNews\SkyParser::parse
     */
    public function testParseMethodReturnsExpectedStructure()
    {
        $parserMock = Mockery::mock(SkyParser::class);

        $parserMock->shouldReceive('parse')->andReturn([
            [
                'thumbnail' => '...',
                'header' => '...',
                'content' => '...',
            ],
        ]);

        $result = $parserMock->parse();

        $this->assertIsArray($result);

        $this->assertNotEmpty($result);

        foreach ($result as $item) {
            $this->assertIsArray($item);
            $this->assertArrayHasKey('thumbnail', $item);
            $this->assertArrayHasKey('header', $item);
            $this->assertArrayHasKey('content', $item);
        }
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
