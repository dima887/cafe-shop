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
    static public function getAllCategory(): array
    {
        return Order::all()->toArray();
    }

    /**
     * Get order by ID
     *
     * @param int $id
     * @return mixed
     */
    static public function getOrderById(int $id): mixed
    {
        return Order::findOrFail($id);
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
