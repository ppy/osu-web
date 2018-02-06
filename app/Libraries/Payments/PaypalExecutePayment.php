<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
