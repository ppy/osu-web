<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Exceptions\InvariantException;
use App\Models\Store\Order;
use App\Traits\StoreNotifiable;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpResponse;

/**
 * Executes an approved Paypal Payment for a store Order.
 *
 * Using the Paypal REST API for payments is a 2-phase process;
 * This class handles the 2nd phase of a payment that the user has already approved
 * through Paypal. Executing the payment will tell paypal to complete the transaction.
 */
class PaypalExecutePayment
{
    use StoreNotifiable;

    public HttpResponse $response;

    public function __construct(private Order $order, private ?string $reference)
    {
        if (!present($reference)) {
            throw new InvariantException('Missing reference number.');
        }

        if ($reference !== $order->reference) {
            throw new InvariantException('Mismatched reference number.');
        }
    }

    public function run()
    {
        $this->order->getConnection()->transaction(function () {
            // prevent concurrent updates
            $order = $this->order->lockSelf();
            if ($order->isProcessing() === false) {
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` in wrong state: `{$order->status}`"
                );
            }

            $order->status = 'checkout';
            $order->saveOrExplode();

            $client = PaypalApiContext::client();
            $request = new OrdersCaptureRequest($this->reference);

            $this->response = $client->execute($request);
        });
    }
}
