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
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

/**
 * Creates a Paypal Payment for a store Order.
 *
 * Using the Paypal REST API for payments is a 2-phase process;
 * This class handles the creation of a payment for the user to approve.
 */
class PaypalCreatePayment
{
    use StoreNotifiable;

    private $order;
    private $payment;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($this->getRedirectUrls())
            ->setTransactions([$this->getTransaction()]);

        $this->payment = $payment;
    }

    public function getApprovalLink()
    {
        try {
            $context = PaypalApiContext::get();
            $this->payment->create($context);

            return $this->payment->getApprovalLink();
        } catch (PayPalConnectionException $e) {
            \Log::error($e->getData());
            // TODO: get more context data
            $this->notifyOrder($this->order, $e->getData());
            throw $e;
        }
    }

    public function getPayment()
    {
        return $this->payment;
    }

    private function getAmount()
    {
        $details = new Details();
        $details->setShipping($this->order->getShipping())
            ->setSubtotal($this->order->getSubTotal());

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($this->order->getTotal())
            ->setDetails($details);

        return $amount;
    }

    private function getItemList()
    {
        $list = new ItemList();
        $list->setItems([
            (new Item())->setName($this->order->getOrderName())
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setSku($this->order->getOrderNumber())
                ->setPrice($this->order->getSubTotal())
            ]);

        return $list;
    }

    private function getRedirectUrls()
    {
        $urls = new RedirectUrls();
        $urls->setReturnUrl(route('payments.paypal.approved', ['order_id' => $this->order->order_id]))
            ->setCancelUrl(route('payments.paypal.declined', ['order_id' => $this->order->order_id]));

        return $urls;
    }

    private function getTransaction()
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->getAmount())
            ->setItemList($this->getItemList())
            ->setDescription($this->order->getOrderName())
            ->setInvoiceNumber($this->order->getOrderNumber());

        return $transaction;
    }
}
