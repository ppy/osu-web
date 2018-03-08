<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Listeners\Fulfillments;

use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Traits\StoreNotifiable;
use DB;
use Exception;

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
}
