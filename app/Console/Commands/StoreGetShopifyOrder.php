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
use Shopify\Utils;

class StoreGetShopifyOrder extends Command
{
    protected $description = 'Gets order info from shopify.';
    protected $signature = 'store:get-shopify-order {orderId}';

    private static function makeQuery(string $gid): ?string
    {
        $id = '"'.$gid.'"';

        return match (true) {
            str_starts_with($gid, 'gid://shopify/Checkout') => <<<QUERY
            {
                node(id: $id) {
                    ... on Checkout {
                        id
                        ready
                        completedAt
                        updatedAt
                        order {
                            canceledAt
                            financialStatus
                            fulfillmentStatus
                            id
                            orderNumber
                            processedAt
                            statusUrl
                        }
                    }
                }
            }
            QUERY,

            str_starts_with($gid, 'gid://shopify/Order') => <<<QUERY
            {
                node(id: $id) {
                    ... on Order {
                        canceledAt
                        financialStatus
                        fulfillmentStatus
                        id
                        orderNumber
                        processedAt
                        statusUrl
                    }
                }
            }
            QUERY,

            str_starts_with($gid, 'gid://shopify/Cart') => <<<QUERY
            {
                cart(id: $id) {
                    createdAt
                    id
                    checkoutUrl
                }
            }
            QUERY,

            default => null,
        };
    }

    public function handle()
    {
        $order = Order::findOrFail(get_int($this->argument('orderId')));
        if ($order->provider !== 'shopify') {
            $this->error('Not a Shopify order');
            return static::INVALID;
        }

        $this->info("Getting details for Order {$order->getKey()}");

        $gid = $order->reference;
        if (!isset(Utils::getQueryParams($gid)['key'])) {
            $this->error('Missing key param in id for querying');
            return static::INVALID;
        }

        $this->warn('The id and statusUrl returned are private and should not be shared!');

        $query = static::makeQuery($gid);

        if ($query === null) {
            $this->error('Not a supported Shopify ID for querying.');
            return static::INVALID;
        }

        Context::initialize(
            // public unauthenticated Storefront API doesn't need OAuth and we can't use blanks.
            'unauthenticated_only',
            'unauthenticated_only',
            'unauthenticated_read_checkouts,unauthenticated_read_customers',
            $GLOBALS['cfg']['store']['shopify']['domain'],
            new FileSessionStorage(),
            ApiVersion::APRIL_2023, // TODO: bump version after updating all checkouts to orders.
        );

        $client = new Storefront(
            $GLOBALS['cfg']['store']['shopify']['domain'],
            $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        );

        $response = $client->query($query);
        $body = $response->getDecodedBody() ?? '';
        $this->line(is_array($body) ? json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $body);
    }
}
