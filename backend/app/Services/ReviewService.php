<?php

namespace App\Services;

use App\Dto\Review\ReviewCreateDto;
use App\Dto\Review\ReviewUpdateDto;
use App\Http\Repositories\ReviewRepository;
use App\Models\Review;

class ReviewService
{
    /**
     * Save new review
     *
     * @param ReviewCreateDto $request
     * @return bool
     */
    public function create(ReviewCreateDto $request): bool
    {
        $review = new Review();

        $review->review = $request->review;
        $review->user_id = $request->user_id;
        $review->product_id = $request->product_id;

        return $review->save();
    }

    /**
     * Update review
     *
     * @param ReviewUpdateDto $request
     * @return mixed
     */
    public function update(ReviewUpdateDto $request): mixed
    {
        $review = ReviewRepository::getReviewById($request->id);

        $review->review = $request->review;
        $review->user_id = $request->user_id;
        $review->product_id = $request->product_id;

        return $review->save();
    }

    /**
     * Delete review by ID
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Review::destroy($id);
    }
}
