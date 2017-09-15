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
use DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalExecutePayment
{
    private $execution;
    private $order;
    private $params;

    public function __construct(Order $order, array $params)
    {
        $this->params = $params;

        $this->order = $order;

        $this->execution = new PaymentExecution();
        $this->execution->setPayerId($params['payerId']);
        $this->execution->addTransaction($this->getTransaction());
    }

    public function run()
    {
        DB::connection('mysql-store')->transaction(function () use (&$context) {
            $context = PaypalApiContext::get();

            // prevent concurrent updates
            $order = Order::lockForUpdate()->find($this->order->order_id);
            if ($order->status !== 'incart') {
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` in wrong state: `{$order->status}`"
                );
            }

            $payment = Payment::get($this->params['paymentId'], $context);
            $result = $payment->execute($this->execution, $context);
            \Log::debug($result);

            $order->status = 'checkout';
            $order->save();
        });

        return Payment::get($this->params['paymentId'], $context);
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
            ->setShipping($this->order->getShipping())
            ->setSubtotal($this->order->getSubTotal());
    }

    private function getTransaction()
    {
        return (new Transaction())->setAmount($this->getAmount());
    }
}
