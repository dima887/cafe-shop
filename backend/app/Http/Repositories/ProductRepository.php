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
        return Product::all()->toArray();
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @return mixed
     */
    static public function getProductById(int $id): mixed
    {
        return Product::findOrFail($id);
    }
}
