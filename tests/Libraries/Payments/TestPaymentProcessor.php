<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\PaymentProcessor;

class TestPaymentProcessor extends PaymentProcessor
{
    public function getCountryCode(): ?string
    {
        return $this->params['countryCode'];
    }

    public function getOrderNumber(): string
    {
        return $this->params['orderNumber'];
    }

    public function getPaymentProvider(): string
    {
        return 'test';
    }

    public function getPaymentTransactionId(): string
    {
        return $this->params['paymentTransactionId'];
    }

    public function getPaymentAmount(): float
    {
        return $this->params['paymentAmount'];
    }

    public function getPaymentDate(): \DateTimeInterface
    {
        return $this->params['paymentDate'];
    }

    public function getNotificationType(): string
    {
        return $this->params['notificationType'];
    }

    public function getNotificationTypeRaw(): string
    {
        return $this->params['notificationType'];
    }

    public function isTest(): bool
    {
        return true;
    }

    public function validateTransaction(): bool
    {
        return true;
    }
}
