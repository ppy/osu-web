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
use Carbon\Carbon;

// FIXME: rename?
class CentiliPaymentProcessor extends PaymentProcessor
{
    public function getOrderNumber()
    {
        return $this['reference'] ?? $this['clientid'];
    }

    public function getPaymentProvider()
    {
        return 'centili';
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
        if ($this->getNotificationType() === NotificationType::PAYMENT
            && $order->isAwaitingPayment() === false) {
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
