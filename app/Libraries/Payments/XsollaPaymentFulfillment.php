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
class XsollaPaymentFulfillment extends PaymentFulfillment
{
    const VALID_NOTIFICATION_TYPES = ['payment', 'refund', 'user_validation'];

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
        return "xsolla-{$this['transaction.id']}";
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
        if (!in_array($this['notification_type'], static::VALID_NOTIFICATION_TYPES, true)) {
            $this->addError("notification_type is not valid: '{$this['notification_type']}'");
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
