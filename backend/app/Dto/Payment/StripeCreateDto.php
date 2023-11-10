<?php

namespace App\Dto\Payment;

readonly final class StripeCreateDto
{

    /**
     * @param array $products
     * @param int $user_id
     * @param int $type_order_id
     * @param string $success_url
     * @param string $cancel_url
     */
    public function __construct(
        public array $products,
        public int $user_id,
        public int $type_order_id,
        public string $success_url,
        public string $cancel_url,
    )
    {}
}
