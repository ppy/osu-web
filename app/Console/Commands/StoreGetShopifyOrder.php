<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Libraries\Shopify;
use App\Models\Store\Order;
use Illuminate\Console\Command;
use Shopify\Utils;

class StoreGetShopifyOrder extends Command
{
    protected $description = 'Gets order info from shopify.';
    protected $signature = 'store:get-shopify-order {orderId} {--u|update : Updates the existing Order if possible}';

    private ?string $gidType;

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

        $this->gidType = Shopify::gidType($gid);
        $query = $this->makeQuery($gid);

        if ($query === null) {
            $this->error('Not a supported Shopify ID for querying.');
            return static::INVALID;
        }

        $client = Shopify::storefontClient('unauthenticated_read_checkouts,unauthenticated_read_customers');

        $body = $client->query($query)->getDecodedBody() ?? '';
        $this->line(is_array($body) ? json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $body);

        if (isset($body['errors'])) {
            return static::FAILURE;
        }

        if ($this->option('update')) {
            $this->comment('Updating Order with Shopify details...');
            $orderNode = $this->gidType === 'Order' ? $body['data']['node'] : $body['data']['node']['order'] ?? null;
            if ($orderNode === null) {
                $this->error('Missing order node in response.');
                return static::FAILURE;
            }

            Shopify::updateOrderWithGql($orderNode, $order);
        }
    }

    private function makeQuery(string $gid): ?string
    {
        $id = json_encode($gid, JSON_UNESCAPED_SLASHES);

        return match ($this->gidType) {
            'Cart' => <<<QUERY
            {
                cart(id: $id) {
                    createdAt
                    id
                    checkoutUrl
                }
            }
            QUERY,

            'Checkout' => <<<QUERY
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

            'Order' => <<<QUERY
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

            default => null,
        };
    }
}
