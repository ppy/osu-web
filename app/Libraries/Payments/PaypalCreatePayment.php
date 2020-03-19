<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
