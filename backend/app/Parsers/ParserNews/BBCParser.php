<?php

namespace App\Parsers\ParserNews;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;

/**
 * This Concrete Product implements food news scraping from www.bbc.co.uk
 */
class BBCParser extends Parser
{
    public function __construct()
    {
        $this->urlSource = 'https://www.bbc.co.uk/news/topics/cp7r8vglgq1t';
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
        $data = $this->document->find('.ssrcss-d9gbsd-Promo');

        foreach ($data as $post) {

            if ($post->attr('type') === 'article') {

                $link = $post->first('a[href]')->attr('href');

                $this->documentPost = new Document('https://www.bbc.co.uk' . $link, true);

                $this->setImg($post);

                $this->setHeader($post);

                $this->setContent();

                $this->counter++;
            }

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
        $img = $data->first('.ssrcss-evoj7m-Image')->attr('srcset');

        if (empty($img)) {
            throw new InvalidSelectorException('img value is empty when parsing');
        }

        $this->posts[$this->counter]['thumbnail'] = preg_replace('#((.*\d\d\dw, )(https.*)( \d\d\dw))#', '$3', $img);
    }

    /**
     * Get the header and add them to the posts array
     *
     * @param object $data
     * @throws InvalidSelectorException
     * @return void
     */
    private function setHeader(object $data): void
    {
        $header = $data->text();

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

        $contents = $this->documentPost->find('.ssrcss-11r1m41-RichTextComponentWrapper');

        if (empty($contents)) {
            throw new InvalidSelectorException('content value is empty when parsing');
        }

        foreach ($contents as $content) {
            $this->posts[$this->counter]['content'] .= $content->text();
        }
    }
}
