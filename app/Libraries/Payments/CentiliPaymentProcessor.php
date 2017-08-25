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

    public function __construct(\Illuminate\Http\Request $request)
    {
        parent::__construct($request);
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
        return $this['reference']; // or clientid?
    }

    public function getTransactionId()
    {
        return "centili-{$this['transactionid']}";
    }

    public function getPaymentAmount()
    {
        return $this['enduserprice'];
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
            $this->dispatchValidationFailed();
            throw new InvalidSignatureException();
        }
    }

    public function validateTransaction()
    {
        $this->ensureValidSignature();

        $order = $this->getOrder();
        // order should exist
        if ($order === null) {
            $this->validationErrors()->add('order', '.order');
            return false;
        }

        // id in order number should be correct
        if (count($this->explodedOrderNumber) !== 3) {
            $this->validationErrors()->add('reference', '.order_number.malformed');
        }

        if ((int) $this->explodedOrderNumber[1] !== $order['user_id']) {
            $this->validationErrors()->add('reference', '.order_number.user_id_mismatch');
        }


        \Log::debug("purchase.checkout.amount: {$this['enduserprice']}, {$order->getTotal()}");
        if ($this['enduserprice'] < $order->getTotal()) {
            $this->validationErrors()->add(
                'enduserprice',
                '.purchase.checkout.amount',
                ['expected' => $order->getTotal(), 'actual' => $this['enduserprice']]
            );
        }

        return $this->validationErrors()->isEmpty();
    }

    /**
     * implements ArrayAccess
     */
    public function offsetExists($key)
    {
        return $this->request->exists($key);
    }

    public function offsetGet($key)
    {
        return $this->request->input($key);
    }
}
