<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\StripeCreateRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    /**
     * Submit a payment request using Stripe
     *
     * @throws ApiErrorException
     */
    public function index(StripeCreateRequest $request, PaymentService $paymentService): JsonResponse
    {
        return response()->json($paymentService->payment($request->getDto()));
    }

    /**
     * Response Handler Stripe
     *
     * @param PaymentService $paymentService
     * @return JsonResponse
     */
    public function webhook(PaymentService $paymentService): JsonResponse
    {
        return response()->json($paymentService->webhook());
    }
}
