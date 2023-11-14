<?php

namespace App\Http\Repositories;

use App\Exceptions\ClientException;
use App\Models\Product;

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
