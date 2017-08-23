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
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

// FIXME: rename?
class XsollaPaymentProcessor extends PaymentProcessor
{
    use Validatable;

    const VALID_NOTIFICATION_TYPES = ['payment', 'refund', 'user_validation'];
    const SKIP_NOTIFICATION_TYPES = ['user_search', 'user_validation'];

    private $explodedOrderNumber;
    private $orderId;

    public function __construct(\Illuminate\Http\Request $request)
    {
        parent::__construct($request);
        $this->explodedOrderNumber = explode('-', $this['transaction.external_id'], 3);
        if (count($this->explodedOrderNumber) > 2) {
            $this->orderId = (int) $this->explodedOrderNumber[2];
        }
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
            $this->validationErrors()->add('signature', 'Signatures do not match');
            throw new InvalidSignatureException();
        }
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        // received notification_type should be payment
        if (!in_array($this['notification_type'], static::VALID_NOTIFICATION_TYPES, true)) {
            $this->addError('notification_type', '.notification_type', ['type' => $this['notification_type']]);
        }

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->addError('order', '.order');
            return false;
        }

        // id in order number should be correct
        if (count($this->explodedOrderNumber) !== 3) {
            $this->addError('transaction.external_id', '.transaction.external_id');
        }

        if ((int) $this->explodedOrderNumber[1] !== $order['user_id']) {
            $this->addError('transaction.external_id', '.transaction.user_id_mismatch');
        }

        // order_id in order number should be correct
        // this can't be used if using the xsolla api tester
        // if ((int) $this->explodedOrderNumber[2] !== $order['order_id']) {
        //     $this->addError('mismatching order_id');
        // }

        // order should be in the correct state
        if ($order->status !== 'checkout') {
            $this->addError('order.status', '.order.status.not_checkout');
        }

        if ($this['purchase.checkout.currency'] !== 'USD') {
            $this->addError(
                'purchase.checkout.currency',
                '.purchase.checkout.currency',
                ['type' => $this['purchase.checkout.currency']]
            );
        }

        \Log::debug("purchase.checkout.amount: {$this['purchase.checkout.amount']}, {$order->getTotal()}");
        if ($this['purchase.checkout.amount'] < $order->getTotal()) {
            $this->addError(
                'purchase.checkout.amount',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this['purchase.checkout.amount']]
            );
        }

        return $this->validationErrors()->isEmpty();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'payments';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }

    private function addError(...$args)
    {
        $this->validationErrors()->add(...$args);
    }
}
