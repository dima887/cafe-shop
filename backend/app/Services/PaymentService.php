<?php

namespace App\Services;

use App\Dto\Payment\StripeCreateDto;
use App\Enums\StatusOrder;
use App\Facades\StripeFacade;
use App\Models\Order;
use Stripe\Exception\ApiErrorException;

class PaymentService
{
    /**
     * Get payment page url from Stripe
     *
     * @param StripeCreateDto $stripeCreateDto
     * @return string
     * @throws ApiErrorException
     */
    public function payment(StripeCreateDto $stripeCreateDto): string
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
        try {
            $event = StripeFacade::webhook();

            switch ($event->type) {
                case 'checkout.session.completed':

                    //todo ++sold_count
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
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
