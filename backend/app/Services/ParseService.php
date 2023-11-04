<?php

namespace App\Services;

use App\Factories\ParserNews\ParserNewsFactory;
use App\Models\News;

final class ParseService
{
    /**
     * array for parsed news
     * @var array
     */
    private array $data;

    /**
     * Parsing food news and storing them in a database
     *
     * @param ParserNewsFactory $parserNewsFactory
     * @param int $source
     * @return bool
     */
    public function parseNews(ParserNewsFactory $parserNewsFactory, int $source): bool
    {
        $this->data = $parserNewsFactory->getParse();

        $this->setSourceNewsId($source);

        $this->deleteBySourceId($source);

        return News::insert($this->data);
    }

    /**
     * Delete all entries by source ID
     *
     * @param int $id
     * @return mixed
     */
    public function deleteBySourceId(int $id): mixed
    {
        return News::where('source_news_id', $id)->delete();
    }

    /**
     * Assign a source ID to all entries
     *
     * @param int $id
     * @return void
     */
    private function setSourceNewsId(int $id): void
    {
        $key = 0;
        while ($key < 10) {
            $this->data[$key]['source_news_id'] = $id;
            $key++;
        }
    }
}
