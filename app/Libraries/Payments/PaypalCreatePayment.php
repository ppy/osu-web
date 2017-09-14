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
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalCreatePayment
{
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
        $context = $this->getApiContext(
            config('payments.paypal.client_id'),
            config('payments.paypal.client_secret')
        );

        try {
            $this->payment->create($context);
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            \Log::error($e->getData()); // testing
        }

        return $this->payment->getApprovalLink();
    }

    public function getPayment()
    {
        return $this->payment;
    }

    private function getApiContext($clientId, $clientSecret)
    {
        $context = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $context->setConfig(
            [
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG',
                'cache.enabled' => true,
            ]
        );

        return $context;
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
                ->setPrice($this->order->getTotal())
            ]);

        return $list;
    }

    private function getRedirectUrls()
    {
        $urls = new RedirectUrls();
        $urls->setReturnUrl(route('payments.paypal.completed'))
            ->setCancelUrl(route('payments.paypal.completed'));

        return $urls;
    }

    private function getTransaction()
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->getAmount())
            ->setItemList($this->getItemList())
            ->setDescription($this->order->getOrderName())
            ->setInvoiceNumber($this->order->order_id);

        return $transaction;
    }
}
