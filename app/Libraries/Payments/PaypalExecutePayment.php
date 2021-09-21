<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use Log;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Throwable;

/**
 * Executes an approved Paypal Payment for a store Order.
 *
 * Using the Paypal REST API for payments is a 2-phase process;
 * This class handles the 2nd phase of a payment that the user has already approved
 * through Paypal. Executing the payment will tell paypal to complete the transaction.
 */
class PaypalExecutePayment
{
    public function __construct(private Order $order)
    {
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

            $order->status = Order::STATUS_PAYMENT_APPROVED;
            $order->saveOrExplode();

            $client = PaypalApiContext::client();
            $request = new OrdersCaptureRequest($order->reference);

            $response = $client->execute($request);

            // This block is just extra information for now, errors here should not cause the transaction to fail.
            try {
                Log::debug('PaypalExecutePayment::run complete', (array) $response);
                // This should match the incoming IPN transaction id.
                $transactionId = $response->result->purchase_units[0]->payments->captures[0]->id;
                $order->update(['transaction_id' => "paypal-{$transactionId}"]);
            } catch (Throwable $e) {
                app('sentry')->getClient()->captureException($e);
            }
        });
    }
}
