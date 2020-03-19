<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

use App\Events\MessageableEvent;
use App\Models\Store\Order;

// Generic event for reporting
class OrderFulfillerEvent implements HasOrder, MessageableEvent
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function toMessage()
    {
        return '';
    }
}
