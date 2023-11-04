<?php

namespace App\Factories\ParserNews;

use App\Parsers\ParserNews\Parser;

/**
 * The Creator class declares the factory method that is supposed to return an
 * object of a IParserNews class
 */
abstract class ParserNewsFactory
{

    /**
     * The actual factory method.
     *
     * @return Parser
     */
    abstract public function getParserNews(): Parser;

    /**
     * Get parsed data as an array
     *
     * @return array = ['thumbnail', 'header', 'content']
     */
    public function getParse(): array
    {
        return $this->getParserNews()->parse();
    }
}
