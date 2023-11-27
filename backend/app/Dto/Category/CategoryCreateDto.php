<?php

namespace App\Dto\Category;

readonly final class CategoryCreateDto
{
    /**
     * @param string $category
     * @param string $description
     * @param string $thumbnail
     */
    public function __construct(
        public string $category,
        public string $description,
        public string $thumbnail,
    )
    {}
}
