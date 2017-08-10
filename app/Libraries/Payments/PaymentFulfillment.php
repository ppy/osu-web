<?php

namespace App\Libraries\Payments;

use App\Libraries\Fulfillments\FulfillmentContext;
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

        $context = new FulfillmentContext();
        // This should probably be shoved off into a queue processor somewhere...
        foreach ($this->fulfillers as $type => $fulfiller) {
            $fulfiller->run($context);
            $fulfiller->revoke($context);
        }

        foreach ($this->fulfillers as $type => $fulfiller) {
            $fulfiller->afterRun($context);
            $fulfiller->afterRevoke($context);
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
