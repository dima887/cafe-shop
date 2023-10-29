<?php

namespace App\Dto\Order;

readonly final class OrderUpdateStatusDto
{

    /**
     * @param int $id
     * @param int $status_order
     */
    public function __construct(
        public int $id,
        public int $status_order
    )
    {}
}
