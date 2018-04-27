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
use App\Models\User;
use Carbon\Carbon;

// FIXME: rename?
class XsollaPaymentProcessor extends PaymentProcessor
{
    const PAYMENT_NOTIFICATION_TYPES = ['payment', 'refund'];
    const USER_NOTIFICATION_TYPES = ['user_search', 'user_validation'];

    public function getOrderNumber()
    {
        return $this['transaction.external_id'];
    }

    public function getPaymentProvider()
    {
        return 'xsolla';
    }

    public function getPaymentTransactionId()
    {
        return $this['transaction.id'];
    }

    public function getPaymentAmount()
    {
        // TODO: less floaty
        return (float) $this['purchase.checkout.amount'];
    }

    public function getPaymentDate()
    {
        return Carbon::parse($this['transaction.payment_date'])->setTimezone('UTC');
    }

    public function getNotificationType()
    {
        static $mapping = [
            'payment' => NotificationType::PAYMENT,
            'refund' => NotificationType::REFUND,
            'user_search' => NotificationType::USER_SEARCH,
            'user_validation' => NotificationType::USER_SEARCH,
        ];

        return $mapping[$this->getNotificationTypeRaw()]
            ?? "unknown__{$this->getNotificationTypeRaw()}";
    }

    public function getNotificationTypeRaw()
    {
        return $this['notification_type'];
    }

    public function isTest()
    {
        // temporarily disable.
        return false; //presence($this['transaction.dry_run']);
    }

    public function isSkipped()
    {
        // just double validate for now
        $this->ensureValidSignature();

        $order = $this->getOrder();
        if ($order === null) {
            // force everything to run to trigger all the other errors.
            return false;
        }

        return $this->getNotificationType() === NotificationType::PAYMENT
            && $order->isPaidOrDelivered();
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // received notification_type should be in allowed ranges
        if (!in_array($this['notification_type'], static::PAYMENT_NOTIFICATION_TYPES, true)) {
            $this->validationErrors()->add(
                'notification_type',
                '.notification_type',
                ['type' => $this['notification_type']]
            );
        }

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order.invalid');

            return false;
        }

        // order should be in the correct state
        if ($this->getNotificationType() === NotificationType::PAYMENT
            && $order->isAwaitingPayment() === false) {
            $this->validationErrors()->add('order.status', '.order.status.not_checkout', ['state' => $order->status]);
        }

        if ($this->getNotificationType() === NotificationType::REFUND && !$order->isPaidOrDelivered()) {
            $this->validationErrors()->add('order.status', '.order.status.not_paid', ['state' => $order->status]);
        }

        // All items should be virtual
        if ($order->requiresShipping()) {
            $this->validationErrors()->add(
                'order.items',
                '.order.items.virtual_only',
                ['provider' => $this->getPaymentProvider()]
            );
        }

        if ($this['purchase.checkout.currency'] !== 'USD') {
            $this->validationErrors()->add(
                'purchase.checkout.currency',
                '.purchase.checkout.currency',
                ['type' => $this['purchase.checkout.currency']]
            );
        }

        \Log::debug("purchase.checkout.amount: {$this->getPaymentAmount()}, {$order->getTotal()}");
        if (compare_currency($this->getPaymentAmount(), $order->getTotal()) !== 0) {
            $this->validationErrors()->add(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this->getPaymentAmount()]
            );
        }

        return $this->validationErrors()->isEmpty();
    }

    public function userSearch()
    {
        $userId = $this['notification_type'] === 'user_validation'
            ? $this['user.id']
            : $this['user.public_id'];

        $user = User::find($userId);
        if ($user === null) {
            throw new XsollaUserNotFoundException();
        }

        return ['user' => ['id' => $user->user_id]];
    }
}
