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

class StoreGetShopifyOrder extends Command
{
    protected $description = 'Gets order info from shopify.';
    protected $signature = 'store:get-shopify-order {orderId}';

    private static function checkoutQuery(string $gid)
    {
        $id = '"'.$gid.'"';

        return <<<QUERY
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
        QUERY;
    }

    private static function orderQuery(string $gid)
    {
        $id = '"'.$gid.'"';

        return <<<QUERY
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
        QUERY;
    }

    public function handle()
    {
        $order = Order::findOrFail(get_int($this->argument('orderId')));
        if ($order->provider !== 'shopify') {
            $this->error('Not a Shopify order');
            return static::INVALID;
        }

        $gid = $order->reference;
        $this->info("Getting details for Order {$order->getKey()}");
        $this->warn('The id and statusUrl returned are private and should not be shared!');

        if (str_starts_with($gid, 'gid://shopify/Checkout')) {
            $query = static::checkoutQuery($gid);
        } elseif (str_starts_with($gid, 'gid://shopify/Order')) {
            $query = static::orderQuery($gid);
        } else {
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
