<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

abstract class OrderItemFulfillment implements Fulfillable
{
    protected $orderItem;

    public function __construct($orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function getTransactionId()
    {
        return "{$this->orderItem->order->transaction_id}-{$this->orderItem->id}";
    }
}
