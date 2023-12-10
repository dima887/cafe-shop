<?php

namespace App\Http\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * Get a list of all orders
     *
     * @return array
     */
    static public function getAllOrder(): array
    {
        return Order::with(['product', 'type_order', 'user', 'status_order'])->get()->toArray();
    }

    /**
     * Get order by ID
     *
     * @param int $id
     * @return array
     */
    static public function getOrderById(int $id): array
    {
        return Order::with(['product', 'type_order', 'user', 'status_order'])
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    /**
     * Get a list of all orders by user ID
     *
     * @param int $id
     * @return array
     */
    static public function getOrderByUserId(int $id): array
    {
        return Order::with(['product', 'type_order', 'user', 'status_order'])
            ->where('user_id', $id)
            ->get()
            ->toArray();
    }

    /**
     * Show orders in progress.
     * except closed orders
     *
     * @return array
     */
    static public function getOrderInProgress(): array
    {
        return Order::all()->where('status_id', '!==', 4)->toArray();
    }

    /**
     * Get a list of orders by ID status
     *
     * @param $id
     * @return array
     */
    static public function getOrderByStatusId($id): array
    {
        return Order::all()->where('status_id', $id)->toArray();
    }
}
