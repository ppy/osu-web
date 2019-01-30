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

namespace App\Libraries\Fulfillments;

use App\Models\Store\Order;

class FulfillmentFactory
{
    private $fulfillers = [];
    private $order;

    private function __construct(Order $order)
    {
        $this->order = $order;
    }

    private function createFulfillers()
    {
        $items = $this->order->items()->get();
        foreach ($items as $item) {
            $this->findOrCreateFulfiller(presence($item->product['custom_class']));
        }

        return $this->fulfillers;
    }

    /**
     * Creates or finds a matching OrderFulfiller implementation.
     *
     * @param string $type The custom-class of the OrderItem to find a fulfiller for.
     * 'generic' and null are considered to be the same.
     * @return OrderFulfiller
     */
    private function findOrCreateFulfiller($type)
    {
        if ($type === null) {
            $type = 'generic';
        }

        if (isset($this->fulfillers[$type])) {
            return $this->fulfillers[$type];
        }

        $className = '\\App\\Libraries\\Fulfillments\\'.studly_case($type).'Fulfillment';
        if (!class_exists($className)) {
            throw new InvalidFulfillerException($className);
        }

        $this->fulfillers[$type] = new $className($this->order);

        return $this->fulfillers[$type];
    }

    public static function createFulfillersFor(Order $order)
    {
        $builder = new static($order);

        $fulfillerMap = $builder->createFulfillers();

        return array_values($fulfillerMap);
    }
}
