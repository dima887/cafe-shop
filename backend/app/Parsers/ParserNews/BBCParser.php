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
     * @return array = ['thumbnail', 'header', 'content']
     * @throws InvalidSelectorException
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
     * @return void
     */
    private function setImg(object $data): void
    {
        $img = $data->first('.ssrcss-evoj7m-Image')->attr('srcset');
        $this->posts[$this->counter]['thumbnail'] = preg_replace('#((.*\d\d\dw, )(https.*)( \d\d\dw))#', '$3', $img);
    }

    /**
     * Get the header and add them to the posts array
     *
     * @param object $data
     * @return void
     */
    private function setHeader(object $data): void
    {
        $this->posts[$this->counter]['header'] = $data->text();
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

        $contents = $this->documentPost->find('.ssrcss-11r1m41-RichTextComponentWrapper');

        foreach ($contents as $content) {
            $this->posts[$this->counter]['content'] .= $content->text();
        }
    }
}
