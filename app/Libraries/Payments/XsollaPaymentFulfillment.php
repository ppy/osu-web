<?php

namespace App\Libraries\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Models\Store\Order;
use Carbon\Carbon;
use DB;

// FIXME: rename?
class XsollaPaymentFulfillment extends PaymentFulfillment
{
    public function getOrderId()
    {
        return $this['custom_parameters.order_id'];
    }

    public function getOrderNumber()
    {
        return $this['transaction.external_id'];
    }

    public function getTransactionId()
    {
        return "xsolla-{$this['transaction.payment_method_order_id']}";
    }

    public function getPaymentDate()
    {
        return Carbon::parse($this['transaction.payment_date']);
    }

    public function ensureValidSignature()
    {
        $signature = new XsollaHeaderSignature($this->request);
        // TODO: post many warnings
        if (!$signature->isValid()) {
            throw new InvalidSignatureException();
        }
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // order should exist
        if ($this->order === null) {
            $this->addError('order is not valid');
            return;
        }

        // received notification_type should be payment
        if ($this['notification_type'] !== 'payment') {
            $this->addError('notification_type must be payment');
        }

        // id in order number should be correct
        $orderNumber = $this->getOrderNumber();
        $exploded = explode('-', $orderNumber, 3);
        if (count($exploded) !== 3) {
            $this->addError('order number is busted');
        }

        if (intval($exploded[1]) !== $this->order['user_id']) {
            $this->addError('mismatching user_id');
        }

        // order_id in order number should be correct
        if (intval($exploded[2]) !== $this->order['order_id']) {
            $this->addError('mismatching order_id');
        }

        // order should be in the correct state
        // if ($this->order->status !== 'checkout') {
        //     $this->addError('Order must be checked out first.');
        // }

        if ($this['purchase.checkout.currency'] !== 'USD') {
            $this->addError('payment received should be USD.');
        }

        if ($this['purchase.checkout.amount'] < $this->order->getTotal()) {
            $this->addError('payment amount is too low');
        }
    }

    private function addError($message)
    {
        // TODO: add to dictionary?
        throw new \Exception($message);
    }
}
