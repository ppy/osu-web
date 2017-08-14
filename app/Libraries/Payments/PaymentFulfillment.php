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
use Carbon\Carbon;
use DB;

abstract class PaymentFulfillment implements \ArrayAccess
{
    private $json;
    protected $order;
    protected $request;

    protected $fulfillers = [];

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

    public function apply()
    {
        DB::connection('mysql-store')->transaction(function () use (&$fulfillments) {
            $this->order->paid($this->getTransactionId(), $this->getPaymentDate());
            $this->createFulfillers();
            \Log::debug('commands');
            \Log::debug(array_keys($this->fulfillers));
        });

        // This should probably be shoved off into a queue processor somewhere...
        foreach ($this->fulfillers as $type => $fulfiller) {
            $fulfiller->run();
            $fulfiller->revoke();
        }

        foreach ($this->fulfillers as $type => $fulfiller) {
            $fulfiller->afterRun();
            $fulfiller->afterRevoke();
        }
    }

    private function createFulfillers()
    {
        $items = $this->order->items()->get();
        foreach ($items as $item) {
            $this->findOrCreateFulfiller($item->product['custom_class']);
        }
    }

    private function findOrCreateFulfiller($type)
    {
        if ($type === null) {
            return;
        }

        if (isset($this->fulfillers[$type])) {
            return $this->fulfillers[$type];
        }

        $className = '\\App\\Libraries\\Fulfillments\\' . studly_case($type) . 'Fulfillment';
        $this->fulfillers[$type] = new $className($this->order);
        // should throw if not found

        return $this->fulfillers[$type];
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
