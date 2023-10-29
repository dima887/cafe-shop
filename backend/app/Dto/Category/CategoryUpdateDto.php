<?php

namespace App\Dto\Category;

readonly final class CategoryUpdateDto
{
    /**
     * @param int $id
     * @param string $category
     */
    public function __construct(
        public int $id,
        public string $category
    )
    {}
}
