<?php

namespace App\Factories\ParserNews;

use App\Parsers\ParserNews\Parser;
use App\Parsers\ParserNews\SkyParser;

/**
 * This Concrete Creator supports Sky.
 */
class SkyParserFactory extends ParserNewsFactory
{
    public function getParserNews(): Parser
    {
        return new SkyParser();
    }

}
