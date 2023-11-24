<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    /**
     * Get a list of all products
     *
     * @return array
     */
    static public function getAllProduct(): array
    {
//        $key = 'cached_products';
//
//        $cachedProducts = Cache::store('redis')->get($key);
//
//        if (!$cachedProducts) {
//            $products = Product::with(['category', 'reviews'])->get()->toArray();
//
//            Cache::store('redis')->put($key, $products, now()->addMinutes(10));
//
//            $cachedProducts = $products;
//        }
//
//        return $cachedProducts;

        return Product::with(['category', 'reviews'])->get()->toArray();
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
}
