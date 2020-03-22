<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Listeners\Fulfillments;

use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Mail\StorePaymentCompleted;
use App\Models\Store\Order;
use App\Traits\StoreNotifiable;
use DB;
use Exception;
use Log;
use Mail;

/**
 * store.payments event dispatcher.
 *
 * Listens to the "store.payments" event stream and dispatches the appropriate
 * messages and commands.
 */
class PaymentSubscribers
{
    use StoreNotifiable;

    public function onPaymentCompleted($eventName, $data)
    {
        $event = $data[0] ?? null;
        $fulfillers = FulfillmentFactory::createFulfillersFor($event->order);
        $count = count($fulfillers);
        $this->notifyOrder($event->order, "dispatching `{$count}` fulfillers", $eventName);

        DB::transaction(function () use ($fulfillers, $event, $eventName) {
            try {
                // This should probably be shoved off into a queue processor somewhere...
                foreach ($fulfillers as $fulfiller) {
                    $fulfiller->run();
                }

                static::sendPaymentCompletedMail($event->order);
            } catch (Exception $exception) {
                $this->notifyError($exception, $event->order, $eventName);
                throw $exception;
            }
        });
    }

    public function onPaymentCancelled($eventName, $data)
    {
        $event = $data[0] ?? null;
        $fulfillers = FulfillmentFactory::createFulfillersFor($event->order);
        $count = count($fulfillers);
        $this->notifyOrder($event->order, "dispatching `{$count}` fulfillers", $eventName);

        DB::transaction(function () use ($fulfillers, $event, $eventName) {
            try {
                // This should probably be shoved off into a queue processor somewhere...
                foreach ($fulfillers as $fulfiller) {
                    $fulfiller->revoke();
                }
            } catch (Exception $exception) {
                $this->notifyError($exception, $event->order, $eventName);
                throw $exception;
            }
        });
    }

    public function onPaymentError($eventName, $data)
    {
        // TODO: make notifyError less fruity and more like the other ones.
        $context = array_intersect_key($data, [
            'order_number' => '',
            'notification_type' => '',
            'transaction_id' => '',
        ]);
        $this->notifyError($data['error'], $data['order'], $eventName, $context);
    }

    public function onPaymentPending($eventName, $data)
    {
        $event = $data[0] ?? null;
        $this->notifyOrder($event->order, 'eCheck used; waiting to clear.', $eventName);
    }

    public function onPaymentRejected($eventName, $data)
    {
        $event = $data[0] ?? null;
        $this->notifyOrder($event->order, 'Payment was rejected or aborted before completion.', $eventName);
    }

    public function subscribe($events)
    {
        $events->listen(
            'store.payments.cancelled.*',
            static::class.'@onPaymentCancelled'
        );

        $events->listen(
            'store.payments.completed.*',
            static::class.'@onPaymentCompleted'
        );

        $events->listen(
            'store.payments.error.*',
            static::class.'@onPaymentError'
        );

        $events->listen(
            'store.payments.pending.*',
            static::class.'@onPaymentPending'
        );

        $events->listen(
            'store.payments.rejected.*',
            static::class.'@onPaymentRejected'
        );
    }

    private static function sendPaymentCompletedMail(Order $order)
    {
        if (!$order->isPaidOrDelivered()) {
            Log::warning("Trying to send mail for unpaid order ({$order->order_id}), aborted.");

            return;
        }

        Mail::to($order->user)->queue(new StorePaymentCompleted($order));
    }
}
