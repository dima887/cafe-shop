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
}
