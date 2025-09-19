<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use App\Models\User;
use Carbon\Carbon;

// FIXME: rename?
class XsollaPaymentProcessor extends PaymentProcessor
{
    const PAYMENT_NOTIFICATION_TYPES = ['payment', 'refund'];
    const USER_NOTIFICATION_TYPES = ['user_search', 'user_validation'];

    public function getCountryCode(): ?string
    {
        return $this['user.country'];
    }

    public function getOrderNumber(): string
    {
        return (string) $this['transaction.external_id'];
    }

    public function getPaymentProvider(): string
    {
        return Order::PROVIDER_XSOLLA;
    }

    public function getPaymentTransactionId(): string
    {
        return (string) $this['transaction.id'];
    }

    public function getPaymentAmount(): float
    {
        return (float) $this['purchase.checkout.amount'];
    }

    public function getPaymentDate(): \DateTimeInterface
    {
        return Carbon::parse($this['transaction.payment_date'])->setTimezone('UTC');
    }

    public function getNotificationType(): string
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

    public function getNotificationTypeRaw(): string
    {
        return $this['notification_type'];
    }

    public function isTest(): bool
    {
        // temporarily disable.
        return false; //presence($this['transaction.dry_run']);
    }

    public function isSkipped()
    {
        // just double validate for now
        $this->signature->assertValid();

        $order = $this->getOrder();
        if ($order === null) {
            // force everything to run to trigger all the other errors.
            return false;
        }

        return $this->getNotificationType() === NotificationType::PAYMENT
            && $order->isPaidOrDelivered();
    }

    public function validateTransaction(): bool
    {
        $this->signature->assertValid();

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
        if (
            $this->getNotificationType() === NotificationType::PAYMENT
            && $order->isPendingPaymentCapture() === false
        ) {
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
