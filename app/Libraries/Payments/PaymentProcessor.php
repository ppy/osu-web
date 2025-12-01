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
     */
    abstract public function getCountryCode(): ?string;

    /**
     * Gets a more friendly identifying order number string that represents an Order.
     */
    abstract public function getOrderNumber(): ?string;

    /**
     * string representing the payment provider.
     *
     * @return string
     */
    abstract public function getPaymentProvider(): string;

    /**
     * Transaction ID returned by the payment provider.
     */
    abstract public function getPaymentTransactionId(): string;

    /**
     * Gets the transaction ID for the payment tagged with the payment processor used..
     * Transaction IDs should be unique scoped to the payment processor.
     */
    public function getTransactionId(): string
    {
        return "{$this->getPaymentProvider()}-{$this->getPaymentTransactionId()}";
    }

    /**
     * Gets the payment amount given by the payment provider.
     */
    abstract public function getPaymentAmount(): float;

    /**
     * Gets the payment date given by the payment provider.
     */
    abstract public function getPaymentDate(): \DateTimeInterface;

    /**
     * Gets the type of payment notification.
     */
    abstract public function getNotificationType(): string;

    /**
     * Gets the raw value of the notification type from the payment provider.
     */
    abstract public function getNotificationTypeRaw(): string;

    /**
     * Gets if the payment notification is a test transaction.
     * This should only be used for the final payment notification;
     * it is not set by providers in the intermediate notifications.
     */
    abstract public function isTest();

    /**
     * Validates the transaction.
     * Returns true if the transaction is valid; false, otherwise.
     */
    abstract public function validateTransaction(): bool;

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

        datadog_increment(
            'payment_processor.run',
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
        // This update before anything is so we have something to refer to if anything explodes.
        if ($order !== null) {
            $order->transaction_id = $this->getTransactionId();
            if ($order->reference === null) { // this only affects xsolla at this stage.
                $order->reference = $this->getPaymentTransactionId();
            }
            $order->save();
        }

        $this->assertValidTransaction();

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
        $this->assertValidTransaction();

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->getOrder()->lockSelf();
            $payment = $order->payments->where('cancelled', false)->first();

            if ($payment === null) {
                // payment not processed, manually cancelled.
                app('sentry')->getClient()->captureMessage(
                    static::WARN_CANCEL_MISSING_PAYMENT,
                    null,
                    (new Scope())->setExtra('order_id', $order->getKey())
                );
            }

            // check for pre-existing cancelled payment.
            // Paypal sends multiple notifications that we treat as a cancellation.
            if ($order->payments->where('cancelled', true)->first() !== null) {
                app('sentry')->getClient()->captureMessage(
                    static::WARN_PAYMENT_ALREADY_CANCELLED,
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
        $this->assertValidTransaction();

        datadog_increment('store.payments.pending', ['provider' => $this->getPaymentProvider()]);
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

        datadog_increment('store.payments.rejected', ['provider' => $this->getPaymentProvider()]);
    }

    /**
     * Fetches the Order corresponding to this payment and memoizes it.
     * Overridden in PaypalPaymentProcessor.
     */
    protected function getOrder(): ?Order
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

    private function assertValidTransaction()
    {
        if (!$this->validateTransaction()) {
            throw new PaymentProcessorException($this->getOrder(), $this->validationErrors());
        }
    }

    private function sandboxAssertion()
    {
        if ($this->isTest() && !$GLOBALS['cfg']['payments']['sandbox']) {
            throw new SandboxException('Trying to run a test transaction in a non-sanboxed environment.');
        }
    }
}
