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
use Illuminate\Http\Request;

// FIXME: rename?
class CentiliPaymentProcessor extends PaymentProcessor
{
    public static function createFromRequest(Request $request)
    {
        $signature = new CentiliSignature($request);

        return new static(static::extractParams($request), $signature);
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
        return NotificationType::PAYMENT;
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // this is just to make the existing test pass
        if (!preg_match(static::ORDER_NUMBER_REGEX, $this->getOrderNumber(), $matches)) {
            $this->validationErrors()->add('clientid', '.order_number.malformed');
        }

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order.invalid');

            return false;
        }

        if ((int) $matches['userId'] !== $order['user_id']) {
            $this->validationErrors()->add('clientid', '.order_number.user_id_mismatch');
        }

        if ($this['service'] !== config('payments.centili.api_key')) {
            $this->validationErrors()->add('service', '.param.invalid', ['param' => 'service']);
        }

        // order should be in the correct state
        if ($this->getNotificationType() === NotificationType::PAYMENT
            && !in_array($order->status, ['incart', 'checkout'], true)) {
            $this->validationErrors()->add('order.status', '.order.status.not_checkout', ['state' => $order->status]);
        }

        if ($this->getPaymentAmount() !== $order->getTotal()) {
            $this->validationErrors()->add(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this->getPaymentAmount()]
            );
        }

        return $this->validationErrors()->isEmpty();
    }
}
