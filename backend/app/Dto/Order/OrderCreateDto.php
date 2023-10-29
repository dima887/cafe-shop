<?php

namespace App\Dto\Order;

readonly final class OrderCreateDto
{

    /**
     * @param int $product_id
     * @param int $type_order_id
     * @param int $user_id
     * @param int $status_order_id
     */
    public function __construct(
        public int $product_id,
        public int $type_order_id,
        public int $user_id,
        public int $status_order_id
    )
    {}
}
