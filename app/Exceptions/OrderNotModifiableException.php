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
        $trans = trans($key);

        parent::__construct(
            $trans === $key ? trans('store.order.not_modifiable_exception.default') : $trans
        );

        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}
