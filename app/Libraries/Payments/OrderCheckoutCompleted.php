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

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use DB;

class OrderCheckoutCompleted
{
    public static function run($orderNumber)
    {
        $orderId = Order::getOrderId($orderNumber);
        DB::connection('mysql-store')->transaction(function () use (&$order, $orderId) {
            // select for update will lock the table if the row doesn't exist,
            // so do a double select.
            $order = Order::findOrFail($orderId);
            $order = $order->lockSelf();
            $order->completeCheckout();
        });

        return $order;
    }
}
