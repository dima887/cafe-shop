<?php

namespace App\Http\Repositories;

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
     * @return array
     */
    static public function getProductById(int $id): array
    {
        return Product::with(['category', 'reviews'])->where('id', $id)->get()->toArray();
    }
}
