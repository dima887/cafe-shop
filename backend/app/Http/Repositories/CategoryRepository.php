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
        return Category::all()->toArray();
    }

    /**
     * Get category by ID
     *
     * @param int $id
     * @return mixed
     */
    static public function getCategoryById(int $id): mixed
    {
        return Category::findOrFail($id);
    }
}
