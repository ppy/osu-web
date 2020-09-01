<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use App\Traits\StoreNotifiable;
use DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

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

    private $execution;
    private $order;
    private $params;

    public function __construct(Order $order, array $params)
    {
        $this->params = $params;

        $this->order = $order;

        $this->execution = (new PaymentExecution())
            ->setPayerId($params['payerId'])
            ->addTransaction($this->getTransaction());
    }

    public function run()
    {
        return DB::connection('mysql-store')->transaction(function () {
            $context = PaypalApiContext::get();

            // prevent concurrent updates
            $order = $this->order->lockSelf();
            if ($order->isProcessing() === false) {
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` in wrong state: `{$order->status}`"
                );
            }

            $order->status = 'checkout';
            $order->saveOrExplode();

            try {
                // Tell Paypal to complete the transaction so we can finally clear the cart.
                $payment = Payment::get($this->params['paymentId'], $context);

                return $payment->execute($this->execution, $context);
            } catch (PayPalConnectionException $e) {
                \Log::error($e->getData());
                // TODO: get more context data
                $this->notifyError($e, $this->order);
                throw $e;
            }
        });
    }

    private function getAmount()
    {
        return (new Amount())
            ->setCurrency('USD')
            ->setTotal($this->order->getTotal())
            ->setDetails($this->getDetails());
    }

    private function getDetails()
    {
        return (new Details())
            ->setShipping($this->order->shipping)
            ->setSubtotal($this->order->getSubTotal());
    }

    private function getTransaction()
    {
        return (new Transaction())->setAmount($this->getAmount());
    }
}
