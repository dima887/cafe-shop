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
     * @return array = ['thumbnail', 'header', 'content']
     * @throws InvalidSelectorException
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
     * @return void
     */
    private function setImg(object $data): void
    {
        $this->posts[$this->counter]['thumbnail'] = $data->first('img')->attr('src');
    }

    /**
     * Get the header and add them to the posts array
     *
     * @return void
     * @throws InvalidSelectorException
     */
    private function setHeader(): void
    {
        $this->posts[$this->counter]['header'] = $this->documentPost->first('.sdc-article-header__long-title')->text();
    }

    /**
     * Get the content and add them to the posts array
     *
     * @return void
     * @throws InvalidSelectorException
     */
    private function setContent(): void
    {
        $this->posts[$this->counter]['content'] = '';

        $contents = $this->documentPost->find('.sdc-article-body');

        foreach ($contents as $content) {
            $this->posts[$this->counter]['content'] .= $content->text();
        }
    }
}
