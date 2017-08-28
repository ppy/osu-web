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
class XsollaPaymentProcessor extends PaymentProcessor
{
    const VALID_NOTIFICATION_TYPES = ['payment', 'refund', 'user_validation'];
    const SKIP_NOTIFICATION_TYPES = ['user_search', 'user_validation'];

    private $explodedOrderNumber;
    private $orderId;

    public function __construct(array $params, $signature)
    {
        parent::__construct($params, $signature);
        $this->explodedOrderNumber = explode('-', $this['transaction.external_id'], 3);
        if (count($this->explodedOrderNumber) > 2) {
            $this->orderId = (int) $this->explodedOrderNumber[2];
        }
    }

    public static function createFromRequest(\Illuminate\Http\Request $request)
    {
        $signature = new XsollaHeaderSignature($request);

        return new static(static::extractParams($request), $signature);
    }


    public function isSkipped()
    {
        return in_array($this->getNotificationType(), static::SKIP_NOTIFICATION_TYPES, true);
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getOrderNumber()
    {
        return $this['transaction.external_id'];
    }

    public function getTransactionId()
    {
        return "xsolla-{$this['transaction.id']}";
    }

    public function getPaymentAmount()
    {
        return $this['purchase.checkout.amount'];
    }

    public function getPaymentDate()
    {
        return Carbon::parse($this['transaction.payment_date']);
    }

    public function getNotificationType()
    {
        return $this['notification_type'];
    }

    public function ensureValidSignature()
    {
        // TODO: post many warnings
        if (!$this->signature->isValid()) {
            $this->validationErrors()->add('header.signature', '.signature.not_match');
            $this->throwValidationFailed(new InvalidSignatureException());
        }
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // received notification_type should be payment
        if (!in_array($this['notification_type'], static::VALID_NOTIFICATION_TYPES, true)) {
            $this->validationErrors()->add('notification_type', '.notification_type', ['type' => $this['notification_type']]);
        }

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order.invalid');
            return false;
        }

        // id in order number should be correct
        if (count($this->explodedOrderNumber) !== 3) {
            $this->validationErrors()->add('transaction.external_id', '.order_number.malformed');
        }

        if ((int) $this->explodedOrderNumber[1] !== $order['user_id']) {
            $this->validationErrors()->add('transaction.external_id', '.order_number.user_id_mismatch');
        }

        // order should be in the correct state
        if ($this->getNotificationType() === 'payment' && $order->status !== 'checkout') {
            $this->validationErrors()->add('order.status', '.order.status.not_checkout', ['state' => $order->status]);
        }

        if ($this->getNotificationType() === 'refund' && $order->status !== 'paid') {
            $this->validationErrors()->add('order.status', '.order.status.not_paid', ['state' => $order->status]);
        }

        if ($this['purchase.checkout.currency'] !== 'USD') {
            $this->validationErrors()->add(
                'purchase.checkout.currency',
                '.purchase.checkout.currency',
                ['type' => $this['purchase.checkout.currency']]
            );
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
