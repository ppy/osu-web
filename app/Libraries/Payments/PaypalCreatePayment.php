<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use PayPal\Api\ShippingAddress;
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

    /** @var Order */
    private $order;

    /** @var Payment */
    private $payment;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $payer = (new Payer())
            ->setPaymentMethod('paypal');

        $this->payment = (new Payment())
            ->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($this->getRedirectUrls())
            ->setTransactions([$this->getTransaction()]);

        if (!$this->order->requiresShipping()) {
            // current version of SDK doesn't support application_context, so need to use
            //  an experience profile instead.
            $this->payment->setExperienceProfileId(config('payments.paypal.profiles.no_shipping'));
        }
    }

    public function getApprovalLink()
    {
        $context = PaypalApiContext::get();

        try {
            return $this->payment->create($context)->getApprovalLink();
        } catch (PayPalConnectionException $e) {
            \Log::error($e->getData());
            // TODO: get more context data
            $this->notifyError($e, $this->order);
            throw $e;
        }
    }

    public function getPayment()
    {
        return $this->payment;
    }

    private function getAmount()
    {
        $details = (new Details())
            ->setShipping($this->order->shipping)
            ->setSubtotal($this->order->getSubTotal());

        return (new Amount())
            ->setCurrency('USD')
            ->setTotal($this->order->getTotal())
            ->setDetails($details);
    }

    private function getItemList()
    {
        return (new ItemList())
            ->setItems([
                (new Item())
                    ->setName($this->order->getOrderName())
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setSku($this->order->getOrderNumber())
                    ->setPrice($this->order->getSubTotal()),
            ])
            ->setShippingAddress($this->getShippingAddress());
    }

    private function getRedirectUrls()
    {
        return (new RedirectUrls())
            ->setReturnUrl(route('payments.paypal.approved', ['order_id' => $this->order->order_id]))
            ->setCancelUrl(route('payments.paypal.declined', ['order_id' => $this->order->order_id]));
    }

    private function getShippingAddress()
    {
        if (!$this->order->requiresShipping()) {
            return;
        }

        $address = $this->order->address;

        return (new ShippingAddress())
            ->setCity($address->city)
            ->setCountryCode($address->country_code)
            ->setLine1($address->street)
            ->setPhone($address->phone)
            ->setPostalCode($address->zip)
            ->setRecipientName("{$address->first_name} {$address->last_name}") // what could possibly go wrong?
            ->setState($address->state);
    }

    private function getTransaction()
    {
        return (new Transaction())
            ->setAmount($this->getAmount())
            ->setItemList($this->getItemList())
            ->setDescription($this->order->getOrderName())
            ->setInvoiceNumber($this->order->getOrderNumber());
    }
}
