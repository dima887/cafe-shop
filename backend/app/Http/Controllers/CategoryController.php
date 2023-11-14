<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Cafe Shop API",
 *      description="API for managing menu, orders, and other cafe-related operations.",
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/category",
     *     summary="Get a list of all categories",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="price", type="double"),
     *                     @OA\Property(property="thumbnail", type="string"),
     *                     @OA\Property(property="sold_count", type="integer"),
     *                     @OA\Property(property="category_id", type="integer"),
     *                 )
     *             ),
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
        return response()->json(CategoryRepository::getAllCategory());
    }

    /**
     * @OA\Get(
     *     path="/api/category/{id}",
     *     summary="Get category by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="price", type="double"),
     *                     @OA\Property(property="thumbnail", type="string"),
     *                     @OA\Property(property="sold_count", type="integer"),
     *                     @OA\Property(property="category_id", type="integer"),
     *                 )
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Category not found"
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
        return response()->json(CategoryRepository::getCategoryById($id));
    }

    /**
     * @OA\Post(
     *     path="/api/category",
     *     summary="Save new category",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"category"},
     *             @OA\Property(property="category", type="string", example="New Category"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Category successfully created",
     *         @OA\JsonContent(
     *             type="boolean",
     *             example=true
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
     * @param CategoryCreateRequest $request
     * @param CategoryService $categoryService
     * @return JsonResponse
     */
    public function store(CategoryCreateRequest $request, CategoryService $categoryService): JsonResponse
    {
        return response()->json($categoryService->create($request->getDto()), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/category/{id}",
     *     summary="Update category by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description"},
     *             @OA\Property(property="category", type="string", example="Updated Category"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Category successfully updated",
     *         @OA\JsonContent(
     *             type="boolean",
     *             example=true
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Category not found"),
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
     * @param CategoryUpdateRequest $request
     * @param CategoryService $categoryService
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, CategoryService $categoryService, int $id): JsonResponse
    {
        return response()->json($categoryService->update($request->getDto($id)));
    }

    /**
     * @OA\Delete(
     *     path="/api/category/{id}",
     *     summary="Delete category by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Category successfully deleted",
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
     * @param CategoryService $categoryService
     * @param int $id
     * @return JsonResponse
     */
    public function delete(CategoryService $categoryService, int $id): JsonResponse
    {
        return response()->json($categoryService->delete($id));
    }
}
