<?php

namespace App\Http\Repositories;

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
     * @return array
     */
    static public function getCategoryById(int $id): array
    {
        return Category::with('products')->where('id', $id)->get()->toArray();
    }
}
