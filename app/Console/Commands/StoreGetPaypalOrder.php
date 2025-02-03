<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Libraries\Payments\PaypalApiContext;
use App\Models\Store\Order;
use Illuminate\Console\Command;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class StoreGetPaypalOrder extends Command
{
    protected $signature = 'store:get-paypal-order {orderId}';

    protected $description = 'Gets order info from paypal.';

    public function handle()
    {
        $order = Order::findOrFail(get_int($this->argument('orderId')));
        if ($order->provider !== 'paypal') {
            $this->error('Not a Paypal order');
            return static::INVALID;
        }

        $paypalOrderId = $order->reference;
        if ($paypalOrderId === null) {
            $this->error('Missing Paypal order id');
            return static::INVALID;
        }

        $this->comment("Getting details for Order {$order->getKey()}, Paypal Id: {$paypalOrderId}");
        $client = PaypalApiContext::client();
        $response = $client->execute(new OrdersGetRequest($paypalOrderId));

        $this->line(json_encode((array) $response->result, JSON_PRETTY_PRINT));
    }
}
