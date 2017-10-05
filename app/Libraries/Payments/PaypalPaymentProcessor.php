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

class PaypalPaymentProcessor extends PaymentProcessor
{
    public static function createFromRequest(Request $request)
    {
        $signature = new PaypalSignature($request);

        return new static(static::extractParams($request), $signature);
    }

    public function isSkipped()
    {
        return false;
    }

    public function getOrderNumber()
    {
        return $this['invoice'];
    }

    public function getPaymentProvider()
    {
        return 'paypal';
    }

    public function getPaymentTransactionId()
    {
        return $this['txn_id'];
    }

    public function getPaymentAmount()
    {
        // TODO: less floaty
        return (float) $this['payment_gross'];
    }

    public function getPaymentDate()
    {
        return Carbon::parse($this['payment_date']);
    }

    public function getNotificationType()
    {
        static $payment_statuses = ['Completed'];
        static $cancel_statuses = ['Expired', 'Failed', 'Refunded', 'Reversed', 'Voided', 'Canceled_Reversal', 'Denied'];

        if (in_array($this['payment_status'], $payment_statuses, false)) {
            return NotificationType::PAYMENT;
        } elseif (in_array($this['payment_status'], $cancel_statuses, false)) {
            return NotificationType::REFUND;
        } else {
            return $this['payment_status'];
        }
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // to be consistent with the other processors.
        if (!$this->orderNumber->isValid()) {
            $this->validationErrors()->add('item_number', '.order_number.malformed');
        }

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order.invalid');

            return false;
        }

        if ((int) $this->orderNumber->getUserId() !== $order['user_id']) {
            $this->validationErrors()->add('item_number', '.order_number.user_id_mismatch');
        }

        if ($this['receiver_id'] !== config('payments.paypal.merchant_id')) {
            $this->validationErrors()->add('receiver_id', '.param.invalid', ['param' => 'receiver_id']);
        }

        // order should be in the correct state
        if ($this->getNotificationType() === NotificationType::PAYMENT
            && !in_array($order->status, ['incart', 'checkout'], true)) {
            $this->validationErrors()->add('order.status', '.order.status.not_checkout', ['state' => $order->status]);
        }

        \Log::debug("purchase.checkout.amount: {$this->getPaymentAmount()}, {$order->getTotal()}");
        if ($this->getNotificationType() === NotificationType::PAYMENT
            && $this->getPaymentAmount() !== $order->getTotal()) {
            $this->validationErrors()->add(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this->getPaymentAmount()]
            );
        }

        return $this->validationErrors()->isEmpty();
    }
}
