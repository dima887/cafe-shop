<?php

namespace App\Services;

use App\Dto\Product\ProductCreateDto;
use App\Dto\Product\ProductUpdateDto;
use App\Exceptions\ClientException;
use App\Http\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ProductService
{
    /**
     * Save new product
     *
     * @param ProductCreateDto $request
     * @return bool
     * @throws InvalidArgumentException
     */
    public function create(ProductCreateDto $request): bool
    {
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->thumbnail = $request->thumbnail;
        $product->category_id = $request->category_id;

        $key = 'cached_product';
        Cache::store('redis')->delete($key);

        return $product->save();
    }

    /**
     * Update product
     *
     * @param ProductUpdateDto $request
     * @return bool
     * @throws ClientException|InvalidArgumentException
     */
    public function update(ProductUpdateDto $request): bool
    {
        try {
            $product = Product::findOrFail($request->id);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->thumbnail = $request->thumbnail;
            $product->category_id = $request->category_id;

            $key = 'cached_product';
            Cache::store('redis')->delete($key);
            $keyId = 'cached_product_id_' . $request->id;
            Cache::store('redis')->delete($keyId);

            return $product->save();
        } catch (ModelNotFoundException) {
            throw new ClientException('Product not found', 404);
        }
    }

    /**
     * Delete product by ID
     *
     * @param int $id
     * @return int
     * @throws InvalidArgumentException
     */
    public function delete(int $id): int
    {
        $key = 'cached_product';
        Cache::store('redis')->delete($key);
        return Product::destroy($id);
    }

    /**
     * Update quantity of products sold, by product ID
     *
     * @param $id
     * @param $quantity
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function incrementSoldCount($id, $quantity): mixed
    {
        $key = 'cached_product';
        Cache::store('redis')->delete($key);

        return Product::where('id', $id)->increment('sold_count', $quantity);
    }
}
