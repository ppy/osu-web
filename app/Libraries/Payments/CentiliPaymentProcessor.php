<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use Carbon\Carbon;

// FIXME: rename?
class CentiliPaymentProcessor extends PaymentProcessor
{
    public function getCountryCode()
    {
        return $this['country'] ?? $this['countryCode'];
    }

    public function getOrderNumber()
    {
        return $this['reference'] ?? $this['clientid'];
    }

    public function getPaymentProvider()
    {
        return Order::PROVIDER_CENTILLI;
    }

    public function getPaymentTransactionId()
    {
        return $this['transactionid'];
    }

    public function getPaymentAmount()
    {
        // TODO: less floaty
        return $this['enduserprice'] / config('payments.centili.conversion_rate');
    }

    public function getPaymentDate()
    {
        return Carbon::now();
    }

    public function getNotificationType()
    {
        static $mapping = [
            'success' => NotificationType::PAYMENT,
            'failed' => NotificationType::REJECTED,
            'canceled' => NotificationType::REJECTED, // TODO: verify documentation is correct >_>
        ];

        return $mapping[$this->getNotificationTypeRaw()]
            ?? "unknown__{$this->getNotificationTypeRaw()}";
    }

    public function getNotificationTypeRaw()
    {
        return $this['status'];
    }

    public function isTest()
    {
        return false; // No sandbox for Centili :(
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order.invalid');

            return false;
        }

        if ($this['service'] !== config('payments.centili.api_key')) {
            $this->validationErrors()->add('service', '.param.invalid', ['param' => 'service']);
        }

        // order should be in the correct state
        if (
            $this->getNotificationType() === NotificationType::PAYMENT
            && $order->isPendingPaymentCapture() === false
        ) {
            $this->validationErrors()->add('order.status', '.order.status.not_checkout', ['state' => $order->status]);
        }

        // All items should be virtual
        if ($order->requiresShipping()) {
            $this->validationErrors()->add(
                'order.items',
                '.order.items.virtual_only',
                ['provider' => $this->getPaymentProvider()]
            );
        }

        if (strcasecmp($this['country'], 'JP') !== 0) {
            $this->validationErrors()->add('country', '.param.invalid', ['param' => 'country']);
        }

        if (compare_currency($this->getPaymentAmount(), $order->getTotal()) !== 0) {
            $this->validationErrors()->add(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this->getPaymentAmount()]
            );
        }

        return $this->validationErrors()->isEmpty();
    }
}
