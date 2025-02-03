<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Store\Order;
use Illuminate\Console\Command;
use Shopify\ApiVersion;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Storefront;
use Shopify\Context;

class StoreGetShopifyCheckout extends Command
{
    protected $signature = 'store:get-shopify-checkout {orderId}';

    protected $description = 'Gets checkout info from shopify.';

    public function handle()
    {
        $order = Order::findOrFail(get_int($this->argument('orderId')));
        if ($order->provider !== 'shopify') {
            $this->error('Not a Shopify order');
            return static::INVALID;
        }

        $this->comment("Getting details for Order {$order->getKey()}");
        $this->comment($order->reference);

        Context::initialize(
            // public unauthenticated Storefront API doesn't need OAuth and we can't use blanks.
            'unauthenticated_only',
            'unauthenticated_only',
            'unauthenticated_read_checkouts',
            $GLOBALS['cfg']['store']['shopify']['domain'],
            new FileSessionStorage(),
            ApiVersion::APRIL_2023,
        );

        $client = new Storefront(
            $GLOBALS['cfg']['store']['shopify']['domain'],
            $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        );

        $id = '"'.$order->reference.'"';
        $query = <<<QUERY
            {
                node(id: $id) {
                    ... on Checkout {
                        id
                        ready
                        webUrl
                        orderStatusUrl
                        completedAt
                        createdAt
                        updatedAt
                        order {
                            id
                            processedAt
                            orderNumber
                        }
                    }
                }
            }
        QUERY;

        $response = $client->query($query);
        $body = $response->getDecodedBody() ?? '';
        $this->line(is_array($body) ? json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $body);
    }
}
