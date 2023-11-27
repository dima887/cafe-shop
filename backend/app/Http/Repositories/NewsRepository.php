<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\News;

class NewsRepository
{
    /**
     * Get a list of all news
     *
     * @return array
     */
    static public function getAllNews(): array
    {
        return News::all()->toArray();
    }

    /**
     * Get news by ID
     *
     * @param int $id
     * @throws ClientException
     * @return array
     */
    static public function getNewsById(int $id): array
    {
        $category = News::all()->toArray();
        if (!$category) {
            throw new ClientException('Category not found', 404);
        }

        return $category;
    }
}
