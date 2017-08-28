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

use App\Exceptions\InvalidSignatureException;
use App\Models\Store\Order;
use Carbon\Carbon;
use DB;

// FIXME: rename?
class CentiliPaymentProcessor extends PaymentProcessor
{
    private $explodedOrderNumber;
    private $orderId;

    public function __construct(array $params, $request)
    {
        parent::__construct($params, $request);
        $this->explodedOrderNumber = explode('-', $this->getOrderNumber(), 3);
        if (count($this->explodedOrderNumber) > 2) {
            $this->orderId = (int) $this->explodedOrderNumber[2];
        }
    }

    public function isSkipped()
    {
        return false;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getOrderNumber()
    {
        return $this['clientid']; // or reference?
    }

    public function getTransactionId()
    {
        return "centili-{$this['transactionid']}";
    }

    public function getPaymentAmount()
    {
        return $this['enduserprice'] / config('payments.centili.conversion_rate');
    }

    public function getPaymentDate()
    {
        return Carbon::now();
    }

    public function getNotificationType()
    {
        return 'payment';
    }

    public function ensureValidSignature()
    {
        $signature = new CentiliSignature($this->request);
        // TODO: post many warnings
        if (!$signature->isValid()) {
            $this->validationErrors()->add('sign', '.signature.not_match');
            $this->throwValidationFailed(new InvalidSignatureException());
        }
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

        // id in order number should be correct
        if (count($this->explodedOrderNumber) !== 3) {
            $this->validationErrors()->add('clientid', '.order_number.malformed');
        }

        if ((int) $this->explodedOrderNumber[1] !== $order['user_id']) {
            $this->validationErrors()->add('clientid', '.order_number.user_id_mismatch');
        }

        if ($this['service'] !== config('payments.centili.api_key')) {
            $this->validationErrors()->add('service', '.service.invalid');
        }

        \Log::debug("purchase.checkout.amount: {$this->getPaymentAmount()}, {$order->getTotal()}");
        if ($this->getPaymentAmount() < $order->getTotal()) {
            $this->validationErrors()->add(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this->getPaymentAmount()]
            );
        }

        return $this->validationErrors()->isEmpty();
    }
}
