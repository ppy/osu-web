<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Models\Store\OrderItem;

// TODO: remove since this isn't really needed anymore
abstract class OrderItemFulfillment implements Fulfillable
{
    public function __construct(protected OrderItem $orderItem)
    {
    }

    public function getTransactionId()
    {
        return "{$this->orderItem->order->transaction_id}-{$this->orderItem->id}";
    }
}
