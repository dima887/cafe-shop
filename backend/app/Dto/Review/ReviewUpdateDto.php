<?php

namespace App\Dto\Review;

readonly final class ReviewUpdateDto
{

    /**
     * @param int $id
     * @param string $review
     * @param int $user_id
     * @param int $product_id
     */
    public function __construct(
        public int $id,
        public string $review,
        public int $user_id,
        public int $product_id
    )
    {}
}
