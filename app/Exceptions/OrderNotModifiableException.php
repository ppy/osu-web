<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use App\Models\Store\Order;
use Exception;

/**
 * Exception for when the order is not modifiable.
 * The exception message should be safe to display to the user.
 */
class OrderNotModifiableException extends Exception
{
    private $order;

    public function __construct(Order $order)
    {
        $key = "store.order.not_modifiable_exception.{$order->status}";
        $trans = osu_trans($key);

        parent::__construct(
            $trans === $key ? osu_trans('store.order.not_modifiable_exception.default') : $trans
        );

        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}
