<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Store;

use App\Exceptions\InvariantException;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Carbon\Carbon;
use Exception;
use Shopify\ApiVersion;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Storefront;
use Shopify\Context;

class ShopifyOrder
{
    public readonly ?string $gidType;

    public static function storefontClient(string $scopes)
    {
        Context::initialize(
            // public unauthenticated Storefront API doesn't need OAuth and we can't use blanks.
            'unauthenticated_only',
            'unauthenticated_only',
            $scopes,
            $GLOBALS['cfg']['store']['shopify']['domain'],
            new FileSessionStorage(),
            ApiVersion::APRIL_2023, // TODO: bump version after updating all checkouts to orders.
        );

        return new Storefront(
            $GLOBALS['cfg']['store']['shopify']['domain'],
            $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        );
    }

    private static function gidType(string $gid): ?string
    {
        return match (true) {
            str_starts_with($gid, 'gid://shopify/Cart') => 'Cart',
            str_starts_with($gid, 'gid://shopify/Checkout') => 'Checkout',
            str_starts_with($gid, 'gid://shopify/Order') => 'Order',
            default => null,
        };
    }

    public function __construct(public readonly Order $order)
    {
        if ($order->provider !== Order::PROVIDER_SHOPIFY) {
            throw new Exception('Not a Shopify Order.');
        }

        $this->gidType = static::gidType($order->reference);
    }

    // TODO: this can be removed after Checkout ids are migrated, the base64 conversion is for old gids that were base64 encoded.
    public function getCheckoutId(): ?string
    {
        if ($this->gidType === 'Checkout') {
            return $this->order->reference;
        }

        // other values maybe base64 or already converted to non-gids
        $decoded = base64_decode($this->order->reference, true);

        return $decoded === false
            ? null
            : (static::gidType($decoded) === 'Checkout'
                ? $decoded
                : null);
    }

    public function updateOrderWithGql(array $node)
    {
        // validate the id we get is one we can work with.
        if (static::gidType($node['id']) === null) {
            throw new InvariantException('Invalid node id');
        }

        $this->order->getConnection()->transaction(function () use ($node) {
            $params = [
                'reference' => $node['id'],
                'shopify_url' => $node['statusUrl'],
            ];

            $orderNumber = $node['orderNumber'] ?? null;
            if ($orderNumber !== null) {
                $params['transaction_id'] = Order::PROVIDER_SHOPIFY.'-'.$orderNumber;
            }

            if ($node['canceledAt'] !== null) {
                $params['status'] = 'cancelled';
            } elseif ($node['fulfillmentStatus'] === 'FULFILLED') {
                $params['status'] = 'shipped';
            } elseif ($node['financialStatus'] === 'PAID') {
                $params['status'] = 'paid';
            }

            $this->order->update($params);

            if ($orderNumber !== null) {
                if ($node['financialStatus'] === 'PAID') {
                    // fill missing Payment record if missing (webhook failure, etc).
                    $payment = Payment::where(['cancelled' => false, 'order_id' => $this->order->getKey()])->first();
                    if ($payment === null) {
                        $payment = new Payment([
                            'country_code' => $node['billingAddress']['countryCodeV2'],
                            // This api doesn't have the payment so just take the order date
                            'paid_at' => Carbon::parse($node['processedAt'])->utc(),
                            'provider' => Order::PROVIDER_SHOPIFY,
                            'transaction_id' => $orderNumber,
                        ]);

                        $this->order->paid($payment);
                    } else {
                        Payment::where('order_id', $this->order->getKey())->update(['transaction_id' => $orderNumber]);
                    }
                }
            }
        });
    }
}
