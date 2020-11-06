<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Models\Store\Order;
use Carbon\Carbon;

class PaypalPaymentProcessor extends PaymentProcessor
{
    public function getCountryCode()
    {
        return $this['residence_country'];
    }

    public function getOrderNumber()
    {
        // If refund, there might not be an invoice id in production.
        if ($this->getNotificationType() === NotificationType::REFUND) {
            return $this['invoice'] ?? $this['item_number1'];
        } else {
            return $this['invoice'];
        }
    }

    public function getPaymentProvider()
    {
        return Order::PROVIDER_PAYPAL;
    }

    public function getPaymentTransactionId()
    {
        return $this['txn_id'];
    }

    public function getPaymentAmount()
    {
        // TODO: less floaty

        if ($this->getNotificationType() === NotificationType::REFUND) {
            return (float) $this['mc_gross'] + $this['mc_fee'];
        } else {
            return (float) $this['mc_gross'];
        }
    }

    public function getPaymentDate()
    {
        return Carbon::parse($this['payment_date'])->setTimezone('UTC');
    }

    public function isTest()
    {
        return presence($this['test_ipn']);
    }

    public function getNotificationType()
    {
        static $ignored_statuses = ['masspay', 'new_case'];
        static $payment_statuses = ['Completed'];
        static $refund_statuses = ['Refunded', 'Reversed', 'Canceled_Reversal'];
        static $pending_statuses = ['Pending'];
        static $rejected_statuses = ['Declined', 'Denied', 'Expired', 'Failed', 'Voided'];

        $status = $this->getNotificationTypeRaw();
        if (in_array($status, $payment_statuses, true)) {
            return NotificationType::PAYMENT;
        } elseif (in_array($status, $refund_statuses, true)) {
            return NotificationType::REFUND;
        } elseif (in_array($status, $pending_statuses, true)) {
            return NotificationType::PENDING;
        } elseif (in_array($status, $rejected_statuses, true)) {
            return NotificationType::REJECTED;
        } elseif (in_array($status, $ignored_statuses, true)) {
            return NotificationType::IGNORED;
        } else {
            return "unknown__{$status}";
        }
    }

    public function getNotificationTypeRaw()
    {
        return $this['payment_status'] ?? $this['txn_type'];
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

        if ($this['receiver_id'] !== config('payments.paypal.merchant_id')) {
            $this->validationErrors()->add('receiver_id', '.param.invalid', ['param' => 'receiver_id']);
        }

        // order should be in the correct state
        if ($this->isPaymentOrPending()) {
            if ($order->isAwaitingPayment() === false) {
                $this->validationErrors()->add(
                    'order.status',
                    '.order.status.not_checkout',
                    ['state' => $order->status]
                );
            }

            if ($this['mc_currency'] !== 'USD') {
                $this->validationErrors()->add(
                    'mc_currency',
                    '.purchase.checkout.currency',
                    ['type' => $this['mc_currency']]
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
        }

        $this->validatePendingStatus();

        return $this->validationErrors()->isEmpty();
    }

    /**
     * Fetches the Order corresponding to this payment and memoizes it.
     *
     * @return Order
     */
    protected function getOrder()
    {
        return $this->memoize(__FUNCTION__, function () {
            // Order number can come from anywhere when paypal is involved /tableflip.
            // Attempt to find order number, else fallback to paypal's parent transaction ID for refunds,
            //  since the IPN might not include the invoice id.
            if ($this->getNotificationType() === NotificationType::REFUND && $this->getOrderNumber() === null) {
                return Order::withPayments()
                    ->wherePaymentTransactionId($this['parent_txn_id'], Order::PROVIDER_PAYPAL)
                    ->first();
            }

            return Order::withPayments()
                ->whereOrderNumber($this->getOrderNumber())
                ->first();
        });
    }

    private function isPaymentOrPending()
    {
        static $types = [NotificationType::PAYMENT, NotificationType::PENDING];

        return in_array($this->getNotificationType(), $types, true);
    }

    /**
     * Runs validations related to Pending status;
     * adds errors into validationErrors(), does not return anything.
     */
    private function validatePendingStatus()
    {
        if ($this->getNotificationType() !== NotificationType::PENDING) {
            return;
        }

        // only recognize echecks
        if ($this['pending_reason'] !== 'echeck') {
            $this->validationErrors()->add(
                'pending_reason',
                '.paypal.not_echeck',
                ['actual' => $this['pending_reason']]
            );
        }
    }
}
