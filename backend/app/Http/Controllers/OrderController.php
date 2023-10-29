<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderRepository;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateStatusRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Get a list of all orders
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(OrderRepository::getAllCategory());
    }

    /**
     * Get order by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(OrderRepository::getOrderById($id));
    }

    /**
     * Get orders in progress
     *
     * @return JsonResponse
     */
    public function showInProgress(): JsonResponse
    {
        return response()->json(OrderRepository::getOrderInProgress());
    }

    /**
     * Get a list of orders by ID status
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showByStatusId(int $id): JsonResponse
    {
        return response()->json(OrderRepository::getOrderByStatusId($id));
    }

    /**
     * Save new Order
     *
     * @param OrderCreateRequest $request
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function store(OrderCreateRequest $request, OrderService $orderService): JsonResponse
    {
        return response()->json($orderService->create($request->getDto()));
    }

    /**
     * Update order status by ID
     *
     * @param OrderUpdateStatusRequest $request
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function updateStatus(OrderUpdateStatusRequest $request, OrderService $orderService): JsonResponse
    {
        return response()->json($orderService->updateStatus($request->getDto()));
    }
}
