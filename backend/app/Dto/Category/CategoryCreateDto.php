<?php

namespace App\Dto\Category;

readonly final class CategoryCreateDto
{
    /**
     * @param string $category
     */
    public function __construct(
        public string $category
    )
    {}
}
