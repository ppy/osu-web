<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        parent::__construct(static::buildMessage($order));

        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    private static function buildMessage(Order $order)
    {
        switch ($order->status) {
            case 'checkout':
            case 'processing':
                return trans('store.order.not_modifiable_exception.processing');

            case 'paid':
            case 'shipped':
            case 'delivered':
                return trans('store.order.not_modifiable_exception.paid');

            case 'cancelled':
                return trans('store.order.not_modifiable_exception.cancelled');
        }

        return trans('store.order.not_modifiable_exception.default');
    }
}
