<?php

namespace App\Libraries\Payments;

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

        $className = '\\App\\Libraries\\Payments\\' . studly_case($type) . 'CommandBuilder';
        $this->builders[$type] = new $className($this->order);
        // throw if not found

        return $this->builders[$type];
    }

    public function apply()
    {
        $commands = null;
        DB::connection('mysql-store')->transaction(function () {
            $this->order->paid($this->getTransactionId(), $this->getPaymentDate());
            $commands = $this->getCommands();
            \Log::debug('commands');
            \Log::debug($commands);
        });

        return $commands;
    }

    public function getCommands()
    {
        $supporterTags = [];
        $items = $this->order->items()->get();
        foreach ($items as $item) {
            $builder = $this->getBuilder($item->product['custom_class']);
            $builder->addOrderItem($item);
        }

        return array_map(function ($builder) {
            $builder->isValid(); // printing \Log::debug atm...
            return $builder->getCommands();
        }, $this->builders);
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
