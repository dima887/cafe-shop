<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

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
     * Get a list of all categories. From cache
     *
     * @return array
     * @throws InvalidArgumentException
     */
    static public function getAllCategoryFromCache(): array
    {
        $key = 'cached_category';

        $cachedCategory = Cache::store('redis')->get($key);

        if (!$cachedCategory) {
            $category = Category::with('products')->get()->toArray();

            Cache::store('redis')->put($key, $category, now()->addMinutes(10));

            $cachedCategory = $category;
        }

        return $cachedCategory;
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

    /**
     * Get category by ID. From cache
     *
     * @param int $id
     * @return array
     * @throws ClientException|InvalidArgumentException
     */
    static public function getCategoryByIdFromCache(int $id): array
    {
        $key = 'cached_category_id_' . $id;

        $cachedCategory = Cache::store('redis')->get($key);

        if (!$cachedCategory) {
            $category = Category::with('products')->where('id', $id)->get()->toArray();

            Cache::store('redis')->put($key, $category, now()->addMinutes(10));

            $cachedCategory = $category;
        }

        if (!$cachedCategory) {
            throw new ClientException('Category not found', 404);
        }

        return $cachedCategory;
    }
}
