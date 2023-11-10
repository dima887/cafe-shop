<?php

namespace App\Services;

use App\Dto\Payment\StripeCreateDto;
use App\Enums\StatusOrder;
use App\Facades\StripeFacade;
use App\Models\Order;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

final class PaymentService
{
    /**
     * Submit a payment request using Stripe
     *
     * @param StripeCreateDto $stripeCreateDto
     * @return Session
     * @throws ApiErrorException
     */
    public function payment(StripeCreateDto $stripeCreateDto): \Stripe\Checkout\Session
    {
        $stripe = new StripeFacade($stripeCreateDto);
        return $stripe->payment();
    }

    /**
     * Stripe event processing
     *
     * @return bool
     */
    public function webhook(): bool
    {
        $event = StripeFacade::webhook();

        switch ($event->type) {
            case 'checkout.session.completed':

                $data = $event->data->object->metadata;
                $data->product_id = explode(', ', $data->product_id);

                foreach ($data->product_id as $value) {
                    $order = new Order();
                    $order->product_id = $value;
                    $order->user_id = $data->user_id;
                    $order->type_order_id = $data->type_order_id;
                    $order->status_order_id = StatusOrder::Paid->value;
                    if (!$order->save()) return false;
                }
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return true;
    }
}
