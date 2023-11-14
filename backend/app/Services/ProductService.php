<?php

namespace App\Services;

use App\Dto\Product\ProductCreateDto;
use App\Dto\Product\ProductUpdateDto;
use App\Http\Repositories\ProductRepository;
use App\Models\Product;

final class ProductService
{
    /**
     * Save new product
     *
     * @param ProductCreateDto $request
     * @return bool
     */
    public function create(ProductCreateDto $request): bool
    {
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->thumbnail = $request->thumbnail;
        $product->category_id = $request->category_id;

        return $product->save();
    }

    /**
     * Update product
     *
     * @param ProductUpdateDto $request
     * @return bool
     */
    public function update(ProductUpdateDto $request): bool
    {
        $product = Product::findOrFail($request->id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->thumbnail = $request->thumbnail;
        $product->category_id = $request->category_id;

        return $product->save();
    }

    /**
     * Delete product by ID
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Product::destroy($id);
    }
}
