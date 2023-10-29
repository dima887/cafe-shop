<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Get a list of all categories
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(CategoryRepository::getAllCategory());
    }

    /**
     * Get category by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(CategoryRepository::getCategoryById($id));
    }

    /**
     * Save new category
     *
     * @param CategoryCreateRequest $request
     * @param CategoryService $categoryService
     * @return JsonResponse
     */
    public function store(CategoryCreateRequest $request, CategoryService $categoryService): JsonResponse
    {
        return response()->json($categoryService->create($request->getDto()));
    }

    /**
     * Update category by ID
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
     * Delete category by ID
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
