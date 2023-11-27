<?php

namespace App\Http\Repositories;

use App\Models\Review;

class ReviewRepository
{
    /**
     * Get a list of all reviews
     *
     * @return array
     */
    static public function getAllReview(): array
    {
        return Review::all()->toArray();
    }

    /**
     * Get review by ID
     *
     * @param int $id
     * @return mixed
     */
    static public function getReviewById(int $id): mixed
    {
        return Review::findOrFail($id);
    }

    /**
     * Get review by ID product
     *
     * @param int $id
     * @return array
     */
    static public function getReviewByIdProduct(int $id): array
    {
        return Review::with(['user'])->where('product_id', $id)->get()->toArray();
    }
}
