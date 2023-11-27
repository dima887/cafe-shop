<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReviewRepository;
use App\Http\Requests\Review\ReviewCreateRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    /**
     * Get a list of all reviews
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(ReviewRepository::getAllReview());
    }

    /**
     * Get review by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(ReviewRepository::getReviewById($id));
    }

    /**
     * Get review by ID product
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showByIdProduct(int $id): JsonResponse
    {
        return response()->json(ReviewRepository::getReviewByIdProduct($id));
    }

    /**
     * Save new review
     *
     * @param ReviewCreateRequest $request
     * @param ReviewService $reviewService
     * @return JsonResponse
     */
    public function store(ReviewCreateRequest $request, ReviewService $reviewService): JsonResponse
    {
        return response()->json($reviewService->create($request->getDto()));
    }

    /**
     * Update review by ID
     *
     * @param ReviewUpdateRequest $request
     * @param ReviewService $reviewService
     * @param int $id
     * @return JsonResponse
     */
public function update(ReviewUpdateRequest $request, ReviewService $reviewService, int $id): JsonResponse
    {
        return response()->json($reviewService->update($request->getDto($id)));
    }

    /**
     * Delete review by ID
     *
     * @param ReviewService $reviewService
     * @param int $id
     * @return JsonResponse
     */
    public function delete(ReviewService $reviewService, int $id): JsonResponse
    {
        return response()->json($reviewService->delete($id));
    }
}
