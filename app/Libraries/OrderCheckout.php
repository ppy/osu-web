<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Libraries\Payments\InvalidOrderStateException;
use App\Models\Store\Order;
use DB;

class OrderCheckout
{
    public function __construct(private Order $order, private ?string $provider = null, private ?string $providerReference = null)
    {
        if ($provider === Order::PROVIDER_SHOPIFY && $providerReference === null) {
            throw new InvariantException('shopify provider requires a providerReference (checkout id).');
        }
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @return string[]
     */
    public function allowedCheckoutProviders(): array
    {
        if ($this->order->isShouldShopify()) {
            return [Order::PROVIDER_SHOPIFY];
        }

        if ($this->order->getTotal() > 0) {
            $allowed = [Order::PROVIDER_PAYPAL];

            if ($this->allowXsollaPayment()) {
                $allowed[] = Order::PROVIDER_XSOLLA;
            }

            return $allowed;
        }

        return [Order::PROVIDER_FREE];
    }

    public function beginCheckout(): void
    {
        // something that shouldn't happen just happened.
        if (!in_array($this->provider, $this->allowedCheckoutProviders(), true)) {
            throw new InvariantException("{$this->provider} not in allowed checkout providers.");
        }

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->order->lockSelf();
            if (!$order->canCheckout()) {
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` cannot be checked out: `{$order->status}`"
                );
            }

            $order->status = Order::STATUS_PAYMENT_REQUESTED;
            $order->provider = $this->provider;
            $order->reference = $this->providerReference;
            // TODO: maybe don't fill transaction_id at the start anymore?
            $order->transaction_id = $this->providerReference !== null ? "{$this->provider}-{$this->providerReference}" : $this->provider;

            $order->reserveItems();

            $order->saveorExplode();
        });
    }

    public function completeCheckout(): Order
    {
        return DB::connection('mysql-store')->transaction(function () {
            $order = $this->order->lockSelf();

            // cart should only be in:
            // processing -> if user hits the callback first.
            // paid -> if payment provider hits the callback first.
            // any other state should be considered invalid.
            if ($order->isPaymentRequested()) {
                $order->status = Order::STATUS_PAYMENT_APPROVED;
                $order->saveorExplode();
            } elseif (!$order->isPaidOrDelivered()) {
                // TODO: use validation errors instead?
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` in wrong state: `{$order->status}`"
                );
            }

            return $order;
        });
    }

    public function failCheckout(): Order
    {
        return DB::connection('mysql-store')->transaction(function () {
            $order = $this->order->lockSelf();
            if ($order->isPaymentRequested() === false) {
                throw new InvalidOrderStateException(
                    "`Order {$order->order_id}` failed checkout but is not processing"
                );
            }

            $order->transaction_id = "{$this->provider}-failed";
            $order->releaseItems();

            $order->saveorExplode();

            return $order;
        });
    }

    public function validate(): array
    {
        $shouldShopify = $this->order->isShouldShopify();
        // TODO: nested indexed ValidationError...somehow.
        $itemErrors = [];
        $items = $this->order->items()->with('product')->get();
        foreach ($items as $item) {
            $messages = [];
            if (!$item->isValid()) {
                $messages[] = $item->validationErrors()->allMessages();
            }

            $product = $item->product;

            // Checkout process level validations, should not be part of OrderItem validation.
            if ($product === null || !$product->isAvailable()) {
                $messages[] = osu_trans('model_validation/store/product.not_available');
            }

            if (!$product->inStock($item->quantity)) {
                $messages[] = osu_trans('model_validation/store/product.insufficient_stock');
            }

            if ($item->quantity > $product->max_quantity) {
                $messages[] = osu_trans('model_validation/store/product.too_many', ['count' => $product->max_quantity]);
            }

            if ($shouldShopify && !$product->isShopify()) {
                $messages[] = osu_trans('model_validation/store/product.must_separate');
            }

            if ($product->requiresShipping() && !$product->isShopify()) {
                $messages[] = osu_trans('model_validation/store/product.not_available');
            }

            $customClass = $item->getCustomClassInstance();
            if ($customClass !== null) {
                $messages[] = $customClass->validate()->allMessages();
            }

            $flattened = array_flatten($messages);
            if (!empty($flattened)) {
                $itemErrors[$item->id] = $flattened;
            }
        }

        return $itemErrors === [] ? [] : ['orderItems' => $itemErrors];
    }

    /**
     * Helper method for creating an OrderCheckout with just the order number.
     */
    public static function for(?string $orderNumber): self
    {
        return new static(Order::whereOrderNumber($orderNumber)->firstOrFail());
    }

    private function allowXsollaPayment(): bool
    {
        return !$this->order->requiresShipping();
    }
}
