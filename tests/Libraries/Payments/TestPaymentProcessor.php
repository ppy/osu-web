<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\PaymentProcessor;

class TestPaymentProcessor extends PaymentProcessor
{
    public function getCountryCode()
    {
        return $this->params['countryCode'];
    }

    public function getOrderNumber()
    {
        return $this->params['orderNumber'];
    }

    public function getPaymentProvider()
    {
        return 'test';
    }

    public function getPaymentTransactionId()
    {
        return $this->params['paymentTransactionId'];
    }

    public function getPaymentAmount()
    {
        return $this->params['paymentAmount'];
    }

    public function getPaymentDate()
    {
        return $this->params['paymentDate'];
    }

    public function getNotificationType()
    {
        return $this->params['notificationType'];
    }

    public function getNotificationTypeRaw()
    {
        return $this->params['notificationType'];
    }

    public function isTest()
    {
        return true;
    }

    public function validateTransaction()
    {
        return true;
    }
}
