<?php

namespace App\Services;

use App\Dto\Order\OrderCreateDto;
use App\Dto\Order\OrderUpdateStatusDto;
use App\Http\Repositories\OrderRepository;
use App\Models\Order;

final class OrderService
{
    /**
     * Save new order
     *
     * @param OrderCreateDto $request
     * @return bool
     */
    public function create(OrderCreateDto $request): bool
    {
        $order = new Order();

        $order->product_id = $request->product_id;
        $order->type_order_id = $request->type_order_id;
        $order->user_id = $request->user_id;
        $order->status_order_id = $request->status_order_id;

        return $order->save();
    }
    /**
     * Update order status by ID
     *
     * @param OrderUpdateStatusDto $request
     * @return mixed
     */
    public function updateStatus(OrderUpdateStatusDto $request): mixed
    {
        $order = OrderRepository::getOrderById($request->id);

        $order->status_id = $request->status_order;

        return $order->save();

    }
}
