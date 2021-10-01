<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Libraries\Payments\InvalidOrderStateException;
use App\Models\Store\Order;
use DB;
use Request;

class OrderCheckout
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var string|null
     */
    private $provider;

    /** @var string|null */
    private $providerReference;

    public function __construct(Order $order, ?string $provider = null, ?string $providerReference = null)
    {
        if ($provider === Order::PROVIDER_SHOPIFY && $providerReference === null) {
            throw new InvariantException('shopify provider requires a providerReference (checkout id).');
        }

        $this->order = $order;
        $this->provider = $provider;
        $this->providerReference = $providerReference;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string|null
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return string[]
     */
    public function allowedCheckoutProviders()
    {
        if ($this->order->isShouldShopify()) {
            return [Order::PROVIDER_SHOPIFY];
        }

        if ($this->order->getTotal() > 0) {
            $allowed = [Order::PROVIDER_PAYPAL];
            if ($this->allowCentiliPayment()) {
                $allowed[] = Order::PROVIDER_CENTILLI;
            }

            if ($this->allowXsollaPayment()) {
                $allowed[] = Order::PROVIDER_XSOLLA;
            }

            return $allowed;
        }

        return [Order::PROVIDER_FREE];
    }

    /**
     * @return string
     */
    public function getCentiliPaymentLink()
    {
        $params = [
            'apikey' => config('payments.centili.api_key'),
            'country' => 'jp',
            'countrylock' => 'true',
            'reference' => $this->order->getOrderNumber(),
            'price' => $this->order->getTotal() * config('payments.centili.conversion_rate'),
        ];

        return config('payments.centili.widget_url').'?'.http_build_query($params);
    }

    /**
     * @return bool
     */
    public function isShippingDelayed()
    {
        return Order::where('orders.status', 'paid')->count() > config('osu.store.delayed_shipping_order_threshold');
    }

    public function beginCheckout()
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

            $order->status = Order::STATUS_CHECKOUT_STARTED;
            $order->transaction_id = $this->newOrderTransactionId();
            $order->reserveItems();

            $order->saveorExplode();
        });
    }

    public function completeCheckout()
    {
        return DB::connection('mysql-store')->transaction(function () {
            $order = $this->order->lockSelf();

            // cart should only be in:
            // processing -> if user hits the callback first.
            // paid -> if payment provider hits the callback first.
            // any other state should be considered invalid.
            if ($order->isProcessing()) {
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

    public function failCheckout()
    {
        return DB::connection('mysql-store')->transaction(function () {
            $order = $this->order->lockSelf();
            if ($order->isProcessing() === false) {
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

    /**
     * @return array
     */
    public function validate()
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

            // Checkout process level validations, should not be part of OrderItem validation.
            if ($item->product === null || !$item->product->isAvailable()) {
                $messages[] = osu_trans('model_validation/store/product.not_available');
            }

            if (!$item->product->inStock($item->quantity)) {
                $messages[] = osu_trans('model_validation/store/product.insufficient_stock');
            }

            if ($item->quantity > $item->product->max_quantity) {
                $messages[] = osu_trans('model_validation/store/product.too_many', ['count' => $item->product->max_quantity]);
            }

            if ($shouldShopify && !$item->product->isShopify()) {
                $messages[] = osu_trans('model_validation/store/product.must_separate');
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

    /**
     * @return bool
     */
    private function allowCentiliPayment()
    {
        // Geolocation header from Cloudflare
        $isJapan = strcasecmp(request_country(), 'JP') === 0;

        return $isJapan
            && !$this->order->requiresShipping()
            && Request::input('intl') !== '1';
    }

    /**
     * @return bool
     */
    private function allowXsollaPayment()
    {
        return !$this->order->requiresShipping();
    }

    private function newOrderTransactionId()
    {
        return $this->provider === Order::PROVIDER_SHOPIFY ? "{$this->provider}-{$this->providerReference}" : $this->provider;
    }
}
