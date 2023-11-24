<?php

namespace App\Parsers\ParserNews;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;

/**
 * This Concrete Product implements food news scraping from www.news.sky.com
 */
class SkyParser extends Parser
{
    public function __construct()
    {
        $this->urlSource = 'https://news.sky.com/topic/food-6517';
        $this->document = new Document($this->urlSource, true);
    }

    /**
     * Get parsed data as an array
     *
     * @throws InvalidSelectorException
     * @return array = ['thumbnail', 'header', 'content']
     */
    public function parse(): array
    {
        $data = $this->document->find('.sdc-site-tiles__item');

        foreach ($data as $post) {

            $link = $post->first('a[href]')->attr('href');

            $this->documentPost = new Document('https://news.sky.com' . $link, true);

            $this->setImg($post);

            $this->setHeader();

            $this->setContent();

            $this->counter++;
            if ($this->counter >= self::TOTAL_POSTS) {
                break;
            }
        }

        return $this->posts;
    }

    /**
     * Get the images and add them to the posts array
     *
     * @param object $data
     * @throws InvalidSelectorException
     * @return void
     */
    private function setImg(object $data): void
    {
        $img = $data->first('img')->attr('src');

        if (empty($img)) {
            throw new InvalidSelectorException('img value is empty when parsing');
        }

        $this->posts[$this->counter]['thumbnail'] = $img;
    }

    /**
     * Get the header and add them to the posts array
     *
     * @throws InvalidSelectorException
     * @return void
     */
    private function setHeader(): void
    {
        $header = $this->documentPost->first('.sdc-article-header__long-title')->text();

        if (empty($header)) {
            throw new InvalidSelectorException('header value is empty when parsing');
        }

        $this->posts[$this->counter]['header'] = $header;
    }

    /**
     * Get the content and add them to the posts array
     *
     * @throws InvalidSelectorException
     * @return void
     */
    private function setContent(): void
    {
        $this->posts[$this->counter]['content'] = '';

        $contents = $this->documentPost->find('.sdc-article-body');

        if (empty($contents)) {
            throw new InvalidSelectorException('content value is empty when parsing');
        }

        foreach ($contents as $content) {
            $this->posts[$this->counter]['content'] .= $content->text();
        }
    }
}
