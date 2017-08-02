<?php

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use Symfony\Component\HttpFoundation\ParameterBag;

class XsollaNotificationProcessor implements \ArrayAccess
{
    protected $json;
    protected $order;


    public function __construct(array $json)
    {
        $this->json = $json;
        $this->order = Order::find($this->getOrderId());
    }

    public function getOrderId()
    {
        return $this['custom_parameters.order_id'];
    }

    public function getOrderNumber()
    {
        return $this['transaction.external_id'];
    }

    public function validateTransaction()
    {
        // order should exist
        if ($this->order === null) {
            $this->addError('order is not valid');
            return;
        }

        // received notification_type should be payment
        if ($this['notification_type'] !== 'payment') {
            $this->addError('notification_type must be payment');
        }

        // id in order number should be correct
        $orderNumber = $this->getOrderNumber();
        $exploded = explode('-', $orderNumber, 3);
        if (intval($exploded[1]) !== $this->order['user_id']) {
            $this->addError('mismatching user_id');
        }

        // order_id in order number should be correct
        if (intval($exploded[2]) !== $this->order['order_id']) {
            $this->addError('mismatching order_id');
        }

        // order should be in the correct state
        if ($this->order->status !== 'checkout') {
            $this->addError('Order must be checked out first.');
        }

        if ($this['purchase.checkout.currency'] !== 'USD') {
            $this->addError('payment received should be USD.');
        }

        if ($this['purchase.checkout.amount'] < $this->order->getTotal()) {
            $this->addError('payment amount is too low');
        }
    }

    private function addError($message)
    {
        // TODO: add to dictionary?
        throw new \Exception($message);
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
