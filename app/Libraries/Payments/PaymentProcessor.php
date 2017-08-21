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

use App\Events\Fulfillment\PaymentCancelled;
use App\Events\Fulfillment\PaymentCompleted;
use App\Libraries\Fulfillments\Fulfillment;
use App\Models\Store\Order;
use Carbon\Carbon;
use DB;

abstract class PaymentProcessor implements \ArrayAccess
{
    private $json;
    protected $order;
    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
        $this->json = $request->json()->all();
        $this->order = Order::find($this->getOrderId()); // remove query from constructor
    }

    abstract public function getOrderId();
    abstract public function getOrderNumber();
    abstract public function getTransactionId();
    abstract public function getPaymentDate();
    abstract public function validateTransaction();
    abstract public function getNotificationType();

    public function apply()
    {
        DB::connection('mysql-store')->transaction(function () {
            $this->order->paid($this->getTransactionId(), $this->getPaymentDate());
            event(new PaymentCompleted($this->order));
        });
    }

    public function cancel()
    {
        DB::connection('mysql-store')->transaction(function () {
            $this->order->cancel();
            event(new PaymentCancelled($this->order));
        });
    }

    /**
     * implements ArrayAccess
     */
    public function offsetExists($key)
    {
        return array_has($this->json, $key);
    }

    public function offsetGet($key)
    {
        return data_get($this->json, $key);
    }
    public function offsetSet($key, $value)
    {
        throw new \Exception('not supported');
    }

    public function offsetUnset($key)
    {
        throw new \Exception('not supported');
    }
}
