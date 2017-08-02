<?php

namespace App\Libraries\Payments;

use App\Models\Store\Order;

class XsollaNotificationProcessor implements \ArrayAccess
{
    private $json;
    private $order;
    private $request;


    // TODO: accept request instead?
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
        $this->json = $request->json()->all();
        $this->order = Order::find($this->getOrderId()); // remove query from constructor
    }

    public function getOrderId()
    {
        return $this['custom_parameters.order_id'];
    }

    public function getOrderNumber()
    {
        return $this['transaction.external_id'];
    }

    public function apply()
    {
    }

    public function receivedSignature()
    {
        $matches = [];
        preg_match('~^Signature (?<signature>[0-9a-f]{40})$~', $this->request->header('Authorization'), $matches);

        return $matches['signature'];
    }

    public function calculatedSignature()
    {
        return sha1($this->request->getContent() . config('xsolla.secret_key'));
    }

    public function isValidSignature()
    {
        return hash_equals($this->calculatedSignature(), $this->receivedSignature());
    }

    public function validateSignature()
    {
        // TODO: post many warnings
        if (!$this->isValidSignature()) {
            throw new \Exception('Invalid signature');
        }
    }

    public function validateTransaction()
    {
        $this->validateSignature();

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
        if (count($exploded) !== 3) {
            $this->addError('order number is busted');
        }

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
