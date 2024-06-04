<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\Store\PaymentProcessorException;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use Datadog;
use DB;
use Sentry\State\Scope;

abstract class PaymentProcessor implements \ArrayAccess
{
    use Memoizes, Validatable;

    const WARN_CANCEL_MISSING_PAYMENT = 'Cancelling order with no existing payment found.';
    const WARN_PAYMENT_ALREADY_CANCELLED = 'Payment already cancelled.';

    public function __construct(protected array $params, protected PaymentSignature $signature)
    {
        \Log::debug($params);
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
     * @throws InvalidSignatureException thrown if the request signature is invalid.
     * @throws PaymentProcessorException thrown if the validating the order fails.
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
            $GLOBALS['cfg']['datadog-helper']['prefix_web'].'.payment_processor.run',
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
        $order?->update(['transaction_id' => $this->getTransactionId()]);

        if (!$this->validateTransaction()) {
            throw new PaymentProcessorException($order, $this->validationErrors());
        }

        $payment = new Payment([
            'provider' => $this->getPaymentProvider(),
            'transaction_id' => $this->getPaymentTransactionId(),
            'country_code' => $this->getCountryCode(),
            'paid_at' => $this->getPaymentDate(),
        ]);

        (new PaymentCompleted($order, $payment))->handle();
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
            throw new PaymentProcessorException($this->getOrder(), $this->validationErrors());
        }

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->getOrder()->lockSelf();
            $payment = $order->payments->where('cancelled', false)->first();

            if ($payment === null) {
                // payment not processed, manually cancelled.
                app('sentry')->getClient()->captureMessage(
                    'Cancelling order with no existing payment found.',
                    null,
                    (new Scope())->setExtra('order_id', $order->getKey())
                );
            }

            // check for pre-existing cancelled payment.
            // Paypal sends multiple notifications that we treat as a cancellation.
            if ($order->payments->where('cancelled', true)->first() !== null) {
                app('sentry')->getClient()->captureMessage(
                    'Payment already cancelled.',
                    null,
                    (new Scope())->setExtra('order_id', $order->getKey())
                );
            } else {
                $payment?->cancel();
            }

            $order->cancel();
        });
    }

    public function pending()
    {
        $this->sandboxAssertion();

        if (!$this->validateTransaction()) {
            throw new PaymentProcessorException($this->getOrder(), $this->validationErrors());
        }

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->getOrder()->lockSelf();
            // Only supported by Paypal processor atm, so assume eCheck.
            // Change if the situation changes.
            $order->tracking_code = Order::PENDING_ECHECK;
            $order->transaction_id = $this->getTransactionId();
            $order->saveOrExplode();
        });

        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.payments.pending",
            1,
            ['provider' => $this->getPaymentProvider()],
        );
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
        $this->signature->assertValid();

        $order = $this->getOrder();

        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.payments.rejected",
            1,
            ['provider' => $this->getPaymentProvider()],
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
     * implements ArrayAccess.
     */
    public function offsetExists($key): bool
    {
        return array_has($this->params, $key);
    }

    public function offsetGet($key): mixed
    {
        return data_get($this->params, $key);
    }

    public function offsetSet($key, $value): void
    {
        throw new \BadMethodCallException('not supported');
    }

    public function offsetUnset($key): void
    {
        throw new \BadMethodCallException('not supported');
    }

    /**
     * Validatable.
     */
    public function validationErrorsTranslationPrefix(): string
    {
        return 'payments';
    }

    public function validationErrorsKeyBase(): string
    {
        return 'model_validation/';
    }

    private function sandboxAssertion()
    {
        if ($this->isTest() && !$GLOBALS['cfg']['payments']['sandbox']) {
            throw new SandboxException('Trying to run a test transaction in a non-sanboxed environment.');
        }
    }
}
