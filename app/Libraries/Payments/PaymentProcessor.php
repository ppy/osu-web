<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Events\Fulfillments\PaymentEvent;
use App\Events\Fulfillments\ProcessorValidationFailed;
use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ModelNotSavedException;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use Datadog;
use DB;
use Exception;

abstract class PaymentProcessor implements \ArrayAccess
{
    use Memoizes, Validatable;

    protected $params;
    protected $signature;

    public function __construct(array $params, PaymentSignature $signature)
    {
        \Log::debug($params);

        $this->params = $params;
        $this->signature = $signature;
    }

    /**
     * Gets the country code of the payment as returned by the provider.
     *
     * @return string
     */
    abstract public function getCountryCode();

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
            case NotificationType::IGNORED:
                break;
            case NotificationType::PAYMENT:
                $this->apply();
                break;
            case NotificationType::PENDING:
                $this->pending();
                break;
            case NotificationType::REFUND:
                $this->cancel();
                break;
            case NotificationType::REJECTED:
                $this->rejected();
                break;
            case NotificationType::USER_SEARCH:
                $this->userSearch();
                break;
            default:
                throw new UnsupportedNotificationTypeException($type);
        }

        Datadog::increment(
            config('datadog-helper.prefix_web').'.payment_processor.run',
            1,
            ['provider' => $this->getPaymentProvider(), 'type' => $type]
        );
    }

    /**
     * Processes the payment transaction.
     *
     * @return void
     */
    public function apply()
    {
        $this->sandboxAssertion();

        $order = $this->getOrder();
        optional($order)->update(['transaction_id' => $this->getTransactionId()]);

        if (!$this->validateTransaction()) {
            $this->throwValidationFailed(new PaymentProcessorException($this->validationErrors()));
        }

        DB::connection('mysql-store')->transaction(function () use ($order) {
            try {
                // FIXME: less hacky
                if ($order->tracking_code === Order::PENDING_ECHECK) {
                    $order->tracking_code = Order::ECHECK_CLEARED;
                }

                // Using a unique constraint, so we don't need to lock any rows.
                $payment = new Payment([
                    'provider' => $this->getPaymentProvider(),
                    'transaction_id' => $this->getPaymentTransactionId(),
                    'country_code' => $this->getCountryCode(),
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
                $order = $this->getOrder()->lockSelf();
                $payment = $order->payments->where('cancelled', false)->first();

                if ($payment === null) {
                    // payment not processed, manually cancelled.
                    $this->dispatchErrorEvent(
                        new Exception('Cancelling order with no existing payment found.'),
                        $order
                    );
                }

                // check for pre-existing cancelled payment.
                // Paypal sends multiple notifications that we treat as a cancellation.
                if ($order->payments->where('cancelled', true)->first() !== null) {
                    $this->dispatchErrorEvent(
                        new Exception('Payment already cancelled.'),
                        $order
                    );
                }

                $payment?->cancel();
                $order->cancel();

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
        return $this->memoize(__FUNCTION__, function () {
            return Order::withPayments()
                ->whereOrderNumber($this->getOrderNumber())
                ->first();
        });
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
