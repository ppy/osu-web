<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
                    (new Scope)->setExtra('order_id', $this->order->order_id)
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
