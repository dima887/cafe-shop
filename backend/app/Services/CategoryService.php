<?php

namespace App\Services;

use App\Dto\Category\CategoryCreateDto;
use App\Dto\Category\CategoryUpdateDto;
use App\Http\Repositories\CategoryRepository;
use App\Models\Category;

final class CategoryService
{
    /**
     * Save new category
     *
     * @param CategoryCreateDto $request
     * @return bool
     */
    public function create(CategoryCreateDto $request): bool
    {
        $category = new Category();

        $category->category = $request->category;

        return $category->save();
    }

    /**
     * Update category
     *
     * @param CategoryUpdateDto $request
     * @return mixed
     */
    public function update(CategoryUpdateDto $request): mixed
    {
        $category = CategoryRepository::getCategoryById($request->id);

        $category->category = $request->category;

        return $category->save();
    }

    /**
     * Delete category by ID
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Category::destroy($id);
    }
}
