<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Psr\SimpleCache\InvalidArgumentException;

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
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="thumbnail", type="string"),
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
     *                     @OA\Property(property="created_at", type="timestamp"),
     *                     @OA\Property(property="updated_at", type="timestamp"),
     *                 ),
     *                 @OA\Property(property="created_at", type="timestamp"),
     *                 @OA\Property(property="updated_at", type="timestamp"),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function index(): JsonResponse
    {
        return response()->json(CategoryRepository::getAllCategoryFromCache());
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
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="thumbnail", type="string"),
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
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Category not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param int $id
     * @return JsonResponse
     * @throws ClientException|InvalidArgumentException
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(CategoryRepository::getCategoryByIdFromCache($id));
    }

    /**
     * @OA\Post(
     *     path="/api/category",
     *     summary="Save new category",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"category", "description", "thumbnail"},
     *             @OA\Property(property="category", type="string", example="Updated Category"),
     *             @OA\Property(property="description", type="string", example="Updated Description"),
     *             @OA\Property(property="thumbnail", type="string", example="https://via.placeholder.com/640x480.png/00ffcc?text=non"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Category successfully created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example="true")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Forbidden.")
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
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param CategoryCreateRequest $request
     * @param CategoryService $categoryService
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function store(CategoryCreateRequest $request, CategoryService $categoryService): JsonResponse
    {
        return response()->json(['success' => $categoryService->create($request->getDto())], 201);
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
     *             required={"category", "description", "thumbnail"},
     *             @OA\Property(property="category", type="string", example="Updated Category"),
     *             @OA\Property(property="description", type="string", example="Updated Description"),
     *             @OA\Property(property="thumbnail", type="string", example="https://via.placeholder.com/640x480.png/00ffcc?text=non"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Category successfully updated",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example="true")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Category not found")
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
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param CategoryUpdateRequest $request
     * @param CategoryService $categoryService
     * @param int $id
     * @return JsonResponse
     * @throws ClientException|InvalidArgumentException
     */
    public function update(CategoryUpdateRequest $request, CategoryService $categoryService, int $id): JsonResponse
    {
        return response()->json(['success' => $categoryService->update($request->getDto($id))]);
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
     *             type="object",
     *             @OA\Property(property="success", type="int", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param CategoryService $categoryService
     * @param int $id
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function delete(CategoryService $categoryService, int $id): JsonResponse
    {
        return response()->json(['success' => $categoryService->delete($id)]);
    }
}
