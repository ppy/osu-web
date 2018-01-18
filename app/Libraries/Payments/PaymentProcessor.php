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

use App\Events\Fulfillments\PaymentEvent;
use App\Events\Fulfillments\ProcessorValidationFailed;
use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ModelNotSavedException;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;
use Exception;

abstract class PaymentProcessor implements \ArrayAccess
{
    use Validatable;

    protected $params;
    protected $signature;
    protected $order; // Stores memoized result in array, not to be used directly otherwise.

    public function __construct(array $params, PaymentSignature $signature)
    {
        \Log::debug($params);

        $this->params = $params;
        $this->signature = $signature;
    }

    /**
     * Gets a more friendly identifying order number string that represents an Order.
     *
     * @return string
     */
    abstract public function getOrderNumber();

    /**
     * string representing the payment provider.
     *
     * @return string
     */
    abstract public function getPaymentProvider();

    /**
     * Transaction ID returned by the payment provider.
     *
     * @return string
     */
    abstract public function getPaymentTransactionId();

    /**
     * Gets the transaction ID for the payment tagged with the payment processor used..
     * Transaction IDs should be unique scoped to the payment processor.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return "{$this->getPaymentProvider()}-{$this->getPaymentTransactionId()}";
    }

    /**
     * Gets the payment amount given by the payment provider.
     *
     * @return float
     */
    abstract public function getPaymentAmount();

    /**
     * Gets the payment date given by the payment provider.
     *
     * @return Carbon\Carbon
     */
    abstract public function getPaymentDate();

    /**
     * Gets the type of payment notification.
     *
     * @return string
     */
    abstract public function getNotificationType();

    /**
     * Gets the raw value of the notification type from the payment provider.
     *
     * @return string
     */
    abstract public function getNotificationTypeRaw();

    /**
     * Gets if the payment notification is a test transaction.
     * This should only be used for the final payment notification;
     * it is not set by providers in the intermediate notifications.
     *
     * @return bool
     */
    abstract public function isTest();

    /**
     * Validates the transaction.
     * Returns true if the transaction is valid; false, otherwise.
     *
     * @return bool
     */
    abstract public function validateTransaction();

    public function isSkipped()
    {
        return false;
    }

    /**
     * Auto run apply() or cancel() depending on the notification type.
     *
     * @return void
     * @throws UnsupportedNotificationTypeException thrown if the notification type is unsupported.
     */
    public function run()
    {
        $type = $this->getNotificationType();
        switch ($type) {
            case NotificationType::PAYMENT:
                return $this->apply();
            case NotificationType::PENDING:
                return $this->pending();
            case NotificationType::REFUND:
                return $this->cancel();
            case NotificationType::REJECTED:
                return $this->rejected();
            case NotificationType::USER_SEARCH:
                return $this->userSearch();
            default:
                throw new UnsupportedNotificationTypeException($type);
        }
    }

    /**
     * Processes the payment transaction.
     *
     * @return void
     */
    public function apply()
    {
        $this->sandboxAssertion();

        if (!$this->validateTransaction()) {
            $this->throwValidationFailed(new PaymentProcessorException($this->validationErrors()));
        }

        DB::connection('mysql-store')->transaction(function () {
            try {
                $order = $this->getOrder();

                // FIXME: less hacky
                if ($order->tracking_code === Order::PENDING_ECHECK) {
                    $order->tracking_code = Order::ECHECK_CLEARED;
                }

                // Using a unique constraint, so we don't need to lock any rows.
                $payment = new Payment([
                    'provider' => $this->getPaymentProvider(),
                    'transaction_id' => $this->getPaymentTransactionId(),
                    'paid_at' => $this->getPaymentDate(),
                ]);

                if (!$order->payments()->save($payment)) {
                    throw new ModelNotSavedException('failed saving model');
                }

                $order->paid($payment);

                $eventName = "store.payments.completed.{$payment->provider}";
            } catch (Exception $exception) {
                $this->dispatchErrorEvent($exception, $order);
                throw $exception;
            }

            event($eventName, new PaymentEvent($order));
        });
    }

    /**
     * Cancels (by refunding) the payment transaction.
     *
     * @return void
     */
    public function cancel()
    {
        $this->sandboxAssertion();

        if (!$this->validateTransaction()) {
            $this->throwValidationFailed(new PaymentProcessorException($this->validationErrors()));
        }

        DB::connection('mysql-store')->transaction(function () {
            try {
                $order = $this->getOrder();
                $payment = $order->payments->where('cancelled', false)->first();

                if ($payment === null && $order->status === 'cancelled') {
                    // payment not processed, manually cancelled - don't explode
                    // notify and bail out.
                    $this->dispatchErrorEvent(
                        new Exception('Order already cancelled with no existing payment found.'),
                        $order
                    );

                    return;
                }

                $payment->cancel();
                $order->cancel();
                $order->releaseItems();

                $eventName = "store.payments.cancelled.{$payment->provider}";
            } catch (Exception $exception) {
                $this->dispatchErrorEvent($exception, $order);
                throw $exception;
            }

            event($eventName, new PaymentEvent($order));
        });
    }

    public function pending()
    {
        $this->sandboxAssertion();

        if (!$this->validateTransaction()) {
            $this->throwValidationFailed(new PaymentProcessorException($this->validationErrors()));
        }

        DB::connection('mysql-store')->transaction(function () {
            try {
                $order = $this->getOrder()->lockSelf();
                // Only supported by Paypal processor atm, so assume eCheck.
                // Change if the situation changes.
                $order->tracking_code = Order::PENDING_ECHECK;
                $order->transaction_id = $this->getTransactionId();
                $order->saveOrExplode();

                $eventName = "store.payments.pending.{$this->getPaymentProvider()}";
            } catch (Exception $exception) {
                $this->dispatchErrorEvent($exception, $order);
                throw $exception;
            }

            event($eventName, new PaymentEvent($order));
        });
    }

    /**
     * Payment was rejected or aborted for whatever reason.
     * This method is for handling notifications from the payment providers.
     *
     * @return void
     */
    public function rejected()
    {
        // just validate the signature until we make sure validating
        //  the whole transaction doesn't make it explode.
        $this->ensureValidSignature();

        $order = $this->getOrder();
        $eventName = "store.payments.rejected.{$this->getPaymentProvider()}";
        event($eventName, new PaymentEvent($order));
    }

    public function ensureValidSignature()
    {
        // TODO: post many warnings
        if (!$this->signature->isValid()) {
            $this->validationErrors()->add('header.signature', '.signature.not_match');
            $this->throwValidationFailed(new InvalidSignatureException());
        }
    }

    /**
     * Sends a ValidationFailedEvent with the validation errors.
     *
     * @return void
     */
    protected function dispatchValidationFailed()
    {
        event(
            "store.payments.validation.failed.{$this->getPaymentProvider()}",
            new ProcessorValidationFailed($this, $this->validationErrors())
        );
    }

    /**
     * Fetches the Order corresponding to this payment and memoizes it.
     * Overridden in PaypalPaymentProcessor.
     *
     * @return Order
     */
    protected function getOrder()
    {
        if (!isset($this->order)) {
            $this->order = [
                Order::withPayments()
                    ->whereOrderNumber($this->getOrderNumber())
                    ->first(),
            ];
        }

        return $this->order[0];
    }

    /**
     * Convenience method that calls dispatchValidationFailed() and then throws the supplied exception.
     *
     * @param Exception $exception
     * @return void
     */
    protected function throwValidationFailed(Exception $exception)
    {
        $this->dispatchValidationFailed();
        throw $exception;
    }

    /**
     * implements ArrayAccess.
     */
    public function offsetExists($key)
    {
        return array_has($this->params, $key);
    }

    public function offsetGet($key)
    {
        return data_get($this->params, $key);
    }

    public function offsetSet($key, $value)
    {
        throw new \BadMethodCallException('not supported');
    }

    public function offsetUnset($key)
    {
        throw new \BadMethodCallException('not supported');
    }

    /**
     * Validatable.
     */
    public function validationErrorsTranslationPrefix()
    {
        return 'payments';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }

    private function dispatchErrorEvent($exception, $order)
    {
        event("store.payments.error.{$this->getPaymentProvider()}", [
            'error' => $exception,
            'order' => $order,
            'order_number' => $this->getOrderNumber(),
            'notification_type' => "{$this->getNotificationType()} ({$this->getNotificationTypeRaw()})",
            'transaction_id' => $this->getTransactionId(),
        ]);
    }

    private function sandboxAssertion()
    {
        if ($this->isTest() && !config('payments.sandbox')) {
            throw new SandboxException('Trying to run a test transaction in a non-sanboxed environment.');
        }
    }
}
