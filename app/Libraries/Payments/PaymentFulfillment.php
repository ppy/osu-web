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

    protected $builders = [];

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

    private function getBuilder($type)
    {
        if ($type === null) {
            return;
        }

        if (isset($this->builders[$type])) {
            return $this->builders[$type];
        }

        $className = '\\App\\Libraries\\Fulfillments\\' . studly_case($type) . 'Fulfillment';
        $this->builders[$type] = new $className($this->order);
        // throw if not found

        return $this->builders[$type];
    }

    public function apply()
    {
        DB::connection('mysql-store')->transaction(function () use (&$fulfillments) {
            $this->order->paid($this->getTransactionId(), $this->getPaymentDate());
            $this->createFulfillers();
            \Log::debug('commands');
            \Log::debug(array_keys($this->builders));
        });

        $context = new FulfillmentContext();
        // This should probably be shoved off into a queue processor somewhere...
        foreach ($this->builders as $type => $fulfiller) {
            $fulfiller->run($context);
            $fulfiller->revoke($context);
        }

        foreach ($this->builders as $type => $fulfiller) {
            $fulfiller->afterRun($context);
            $fulfiller->afterRevoke($context);
        }
    }

    private function createFulfillers()
    {
        $items = $this->order->items()->get();
        foreach ($items as $item) {
            $this->getBuilder($item->product['custom_class']);
        }
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
