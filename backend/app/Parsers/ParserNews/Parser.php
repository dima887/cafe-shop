<?php

namespace App\Parsers\ParserNews;

use DiDom\Document;

/**
 * A base abstract class with an interface declares the behavior of various product types.
 */
abstract class Parser
{
    protected int $counter = 0;

    /**
     * Total posts to parse
     */
    protected const TOTAL_POSTS = 10;

    /**
     * Document object of all posts
     * @var Document
     */
    protected Document $document;

    /**
     * Single post document object
     * @var Document
     */
    protected Document $documentPost;

    /**
     * Source URL from where the data is parsed
     * @var string
     */
    protected string $urlSource;

    /**
     * Array for parsed data
     * @var array
     */
    protected array $posts = [];

    /**
     * Get parsed data as an array
     *
     * @return array = ['thumbnail', 'header', 'content']
     */
    abstract public function parse(): array;
}
