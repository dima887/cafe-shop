<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/product",
     *     summary="Get a list of all products",
     *     tags={"Products"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="price", type="double"),
     *                     @OA\Property(property="thumbnail", type="string"),
     *                     @OA\Property(property="sold_count", type="integer"),
     *                     @OA\Property(property="category_id", type="integer"),
     *                     @OA\Property(
     *                          property="category",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer"),
     *                              @OA\Property(property="name", type="string"),
     *                              @OA\Property(property="description", type="string"),
     *                              @OA\Property(property="price", type="double"),
     *                          )
     *                     ),
     *                     @OA\Property(
     *                          property="reviews",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer"),
     *                              @OA\Property(property="review", type="string"),
     *                              @OA\Property(property="userd_id", type="integer"),
     *                              @OA\Property(property="product_id", type="integer"),
     *                          )
     *                     ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Oops, there are temporary problems"
     *         )
     *     ),
     * )
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(ProductRepository::getAllProduct());
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     summary="Get product by ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="price", type="double"),
     *                     @OA\Property(property="thumbnail", type="string"),
     *                     @OA\Property(property="sold_count", type="integer"),
     *                     @OA\Property(property="category_id", type="integer"),
     *                     @OA\Property(
     *                          property="category",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer"),
     *                              @OA\Property(property="name", type="string"),
     *                              @OA\Property(property="description", type="string"),
     *                              @OA\Property(property="price", type="double"),
     *                          )
     *                     ),
     *                     @OA\Property(
     *                          property="reviews",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer"),
     *                              @OA\Property(property="review", type="string"),
     *                              @OA\Property(property="userd_id", type="integer"),
     *                              @OA\Property(property="product_id", type="integer"),
     *                          )
     *                     ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Product not found"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Oops, there are temporary problems"
     *         )
     *     ),
     * )
     *
     * @param int $id
     * @throws ClientException
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(ProductRepository::getProductById($id));
    }

    /**
     * @OA\Post(
     *     path="/api/product",
     *     summary="Save new product",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "price", "thumbnail", "category_id"},
     *             @OA\Property(property="name", type="string", example="New Product"),
     *             @OA\Property(property="description", type="string", example="Description of the new product"),
     *             @OA\Property(property="price", type="double"),
     *             @OA\Property(property="thumbnail", type="string"),
     *             @OA\Property(property="category_id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Product successfully created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Oops, there are temporary problems"
     *         )
     *     ),
     * )
     *
     * @param ProductCreateRequest $request
     * @param ProductService $productService
     * @return JsonResponse
     */
    public function store(ProductCreateRequest $request, ProductService $productService): JsonResponse
    {
        return response()->json($productService->create($request->getDto()), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/product/{id}",
     *     summary="Update product by ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "price", "thumbnail", "category_id"},
     *             @OA\Property(property="name", type="string", example="Updated Product"),
     *             @OA\Property(property="description", type="string", example="Updated description of the product"),
     *             @OA\Property(property="price", type="double"),
     *             @OA\Property(property="thumbnail", type="string"),
     *             @OA\Property(property="category_id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Product successfully updated",
     *         @OA\JsonContent(
     *             type="boolean",
     *             example=true
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Product not found"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Oops, there are temporary problems"
     *         )
     *     ),
     * )
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
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     summary="Delete product by ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Product successfully deleted",
     *         @OA\JsonContent(
     *             type="int",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Oops, there are temporary problems"
     *         )
     *     ),
     * )
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
