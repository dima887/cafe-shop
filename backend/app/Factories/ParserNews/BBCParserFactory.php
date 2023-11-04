<?php

namespace App\Factories\ParserNews;

use App\Parsers\ParserNews\BBCParser;
use App\Parsers\ParserNews\Parser;

/**
 * This Concrete Creator supports BBC.
 */
class BBCParserFactory extends ParserNewsFactory
{
    public function getParserNews(): Parser
    {
        return new BBCParser();
    }
}
