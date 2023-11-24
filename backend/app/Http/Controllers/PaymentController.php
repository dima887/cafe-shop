<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\StripeCreateRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/payment",
     *     summary="Get payment page url from Stripe",
     *     tags={"Payments"},
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *         required={"user_id", "type_order_id", "product", "success_url", "cancel_url"},
     *         @OA\Property(property="user_id", type="integer", example=1),
     *         @OA\Property(property="type_order_id", type="integer", example=1),
     *         @OA\Property(
     *             property="product",
     *             type="object",
     *             required={"id", "name", "price", "quantity"},
     *             @OA\Property(property="id", type="array", @OA\Items(type="integer", example=2)),
     *             @OA\Property(property="name", type="array", @OA\Items(type="string", example="Lattes")),
     *             @OA\Property(property="price", type="array", @OA\Items(type="number", format="double", example=5)),
     *             @OA\Property(property="quantity", type="array", @OA\Items(type="integer", example=1)),
     *         ),
     *         @OA\Property(property="success_url", type="string", example="http://localhost:3000/?success=true"),
     *         @OA\Property(property="cancel_url", type="string", example="http://localhost:3000/?success=false"),
     *     )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Stripe payment page URL",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="string", example="https://checkout.stripe.com/c/pay/efsdfdrgrdg")
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param StripeCreateRequest $request
     * @param PaymentService $paymentService
     * @throws ApiErrorException
     * @return JsonResponse
     */
    public function index(StripeCreateRequest $request, PaymentService $paymentService): JsonResponse
    {
        return response()->json(['success' => $paymentService->payment($request->getDto())]);
    }

    /**
     * @OA\Post(
     *     path="/api/payment/webhook",
     *     summary="Handle Stripe webhook response",
     *     tags={"Payments"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example="true")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param PaymentService $paymentService
     * @return JsonResponse
     */
    public function webhook(PaymentService $paymentService): JsonResponse
    {
        return response()->json(['success' => $paymentService->webhook()]);
    }
}
