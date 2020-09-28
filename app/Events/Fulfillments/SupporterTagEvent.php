<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

use App\Events\MessageableEvent;
use App\Models\Store\Order;
use ArrayAccess;
use Sentry\State\Scope;

class SupporterTagEvent implements HasOrder, MessageableEvent
{
    /** @var Order */
    protected $order;

    /** @var ArrayAccess */
    private $orderItems;

    public function __construct(Order $order, ArrayAccess $orderItems)
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
            if ($item->product->custom_class !== 'supporter-tag') {
                // sanity; it shouldn't happen but also make sure it doesn't die.
                app('sentry')->getClient()->captureMessage(
                    'SupporterTagEvent order contains non supporter-tag items.',
                    null,
                    (new Scope())->setExtra('order_id', $this->order->order_id)
                );

                continue;
            }

            $duration = (int) $item->extra_data['duration'];
            $userId = $item->extra_data['target_id'];
            $userLink = route('users.show', $userId);
            $username = $item->extra_data['username'];

            $message .= "\n<{$userLink}|{$username}> ({$userId}) for {$duration} months!";
        }

        return $message;
    }
}
