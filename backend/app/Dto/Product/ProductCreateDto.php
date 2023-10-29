<?php

namespace App\Dto\Product;

readonly final class ProductCreateDto
{

    /**
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $thumbnail
     * @param int $category_id
     */
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public string $thumbnail,
        public int $category_id
    )
    {}
}
