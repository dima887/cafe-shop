<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Get a list of all products
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(ProductRepository::getAllProduct());
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(ProductRepository::getProductById($id));
    }

    /**
     * Save new product
     *
     * @param ProductCreateRequest $request
     * @param ProductService $productService
     * @return JsonResponse
     */
    public function store(ProductCreateRequest $request, ProductService $productService): JsonResponse
    {
        return response()->json($productService->create($request->getDto()));
    }

    /**
     * Update product
     *
     * @param ProductUpdateRequest $request
     * @param ProductService $productService
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, ProductService $productService, int $id): JsonResponse
    {
        return response()->json($productService->update($request->getDto($id)));
    }

    /**
     * Delete product by ID
     *
     * @param ProductService $productService
     * @param int $id
     * @return JsonResponse
     */
    public function delete(ProductService $productService, int $id): JsonResponse
    {
        return response()->json($productService->delete($id));
    }
}
