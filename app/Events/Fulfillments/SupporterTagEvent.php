<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

use App\Events\MessageableEvent;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Sentry\State\Scope;

class SupporterTagEvent implements HasOrder, MessageableEvent
{
    /** @var Order */
    protected $order;

    /** @var iterable<OrderItem> */
    private $orderItems;

    public function __construct(Order $order, iterable $orderItems)
    {
        $this->order = $order;
        $this->orderItems = $orderItems;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function toMessage()
    {
        $message = '';

        foreach ($this->orderItems as $item) {
            if ($item->product->custom_class !== Product::SUPPORTER_TAG_NAME) {
                // sanity; it shouldn't happen but also make sure it doesn't die.
                app('sentry')->getClient()->captureMessage(
                    'SupporterTagEvent order contains non supporter-tag items.',
                    null,
                    (new Scope())->setExtra('order_id', $this->order->order_id)
                );

                continue;
            }

            $extraData = $item->extra_data;
            $duration = $extraData->duration;
            $userId = $extraData->targetId;
            $userLink = route('users.show', $userId);
            $username = $extraData->username;

            $message .= "\n<{$userLink}|{$username}> ({$userId}) for {$duration} months!";
        }

        return $message;
    }
}
