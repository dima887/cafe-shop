<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ProductRepository
{
    /**
     * Get a list of all products
     *
     * @return array
     */
    static public function getAllProduct(): array
    {
        return Product::with(['category', 'reviews'])->get()->toArray();
    }

    /**
     * Get a list of all products. From cache
     *
     * @return array
     * @throws InvalidArgumentException
     */
    static public function getAllProductFromCache(): array
    {
        $key = 'cached_product';

        $cachedProducts = Cache::store('redis')->get($key);

        if (!$cachedProducts) {
            $products = Product::with(['category', 'reviews'])->get()->toArray();

            Cache::store('redis')->put($key, $products, now()->addMinutes(10));

            $cachedProducts = $products;
        }

        return $cachedProducts;
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @throws ClientException
     * @return array
     */
    static public function getProductById(int $id): array
    {
        $product = Product::with(['category', 'reviews'])->where('id', $id)->get()->toArray();
        if (!$product) {
            throw new ClientException('Product not found', 404);
        }
        return $product;
    }

    /**
     * Get product by ID. From cache
     *
     * @param int $id
     * @return array
     * @throws ClientException|InvalidArgumentException
     */
    static public function getProductByIdFromCache(int $id): array
    {
        $key = 'cached_product_id_' . $id;

        $cachedProducts = Cache::store('redis')->get($key);

        if (!$cachedProducts) {
            $product = Product::with(['category', 'reviews'])->where('id', $id)->get()->toArray();

            Cache::store('redis')->put($key, $product, now()->addMinutes(10));

            $cachedProducts = $product;
        }

        if (!$cachedProducts) {
            throw new ClientException('Product not found', 404);
        }

        return $cachedProducts;
    }
}
