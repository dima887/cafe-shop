<?php

namespace App\Services;

use App\Dto\Category\CategoryCreateDto;
use App\Dto\Category\CategoryUpdateDto;
use App\Exceptions\ClientException;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
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
        $category->description = $request->description;
        $category->thumbnail = $request->thumbnail;

        return $category->save();
    }

    /**
     * Update category
     *
     * @param CategoryUpdateDto $request
     * @throws ClientException
     * @return bool
     */
    public function update(CategoryUpdateDto $request): bool
    {
        try {
            $category = Category::findOrFail($request->id);

            $category->category = $request->category;
            $category->description = $request->description;
            $category->thumbnail = $request->thumbnail;

            return $category->save();
        } catch (ModelNotFoundException) {
            throw new ClientException('Category not found', 404);
        }
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
