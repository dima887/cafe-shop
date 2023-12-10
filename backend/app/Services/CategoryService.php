<?php

namespace App\Services;

use App\Dto\Category\CategoryCreateDto;
use App\Dto\Category\CategoryUpdateDto;
use App\Exceptions\ClientException;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class CategoryService
{
    /**
     * Save new category
     *
     * @param CategoryCreateDto $request
     * @return bool
     * @throws InvalidArgumentException
     */
    public function create(CategoryCreateDto $request): bool
    {
        $category = new Category();

        $category->category = $request->category;
        $category->description = $request->description;
        $category->thumbnail = $request->thumbnail;

        $key = 'cached_category';
        Cache::store('redis')->delete($key);

        return $category->save();
    }

    /**
     * Update category
     *
     * @param CategoryUpdateDto $request
     * @return bool
     * @throws ClientException|InvalidArgumentException
     */
    public function update(CategoryUpdateDto $request): bool
    {
        try {
            $category = Category::findOrFail($request->id);

            $category->category = $request->category;
            $category->description = $request->description;
            $category->thumbnail = $request->thumbnail;

            $key = 'cached_category';
            Cache::store('redis')->delete($key);
            $keyId = 'cached_category_id_' . $request->id;
            Cache::store('redis')->delete($keyId);

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
