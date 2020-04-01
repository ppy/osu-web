<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
