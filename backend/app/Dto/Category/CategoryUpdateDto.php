<?php

namespace App\Dto\Category;

readonly final class CategoryUpdateDto
{
    /**
     * @param int $id
     * @param string $category
     * @param string $description
     * @param string $thumbnail
     */
    public function __construct(
        public int $id,
        public string $category,
        public string $description,
        public string $thumbnail,
    )
    {}
}
