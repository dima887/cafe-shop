<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\Category;

class CategoryRepository
{
    /**
     * Get a list of all categories
     *
     * @return array
     */
    static public function getAllCategory(): array
    {
        return Category::with('products')->get()->toArray();
    }

    /**
     * Get category by ID
     *
     * @param int $id
     * @throws ClientException
     * @return array
     */
    static public function getCategoryById(int $id): array
    {
        $category = Category::with('products')->where('id', $id)->get()->toArray();
        if (!$category) {
            throw new ClientException('Category not found', 404);
        }

        return $category;
    }
}
