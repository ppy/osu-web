<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Store\Order;
use App\Models\Store\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Shopify\ApiVersion;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Storefront;
use Shopify\Context;

class StoreUpdateShopifyCheckoutId extends Command
{
    protected $signature = 'store:update-shopify-checkout-id';

    protected $description = 'Updates Shopify orders using checkout id to order number.';

    private Storefront $client;

    private static function getOrderIdFromNode(array $node): ?int
    {
        // array of name-value pairs.
        $attributes = $node['customAttributes'];

        foreach ($attributes as $attribute) {
            if ($attribute['key'] === 'orderId') {
                return get_int($attribute['value']);
            }
        }

        return null;
    }

    public function handle()
    {
        Context::initialize(
            // public unauthenticated Storefront API doesn't need OAuth and we can't use blanks.
            'unauthenticated_only',
            'unauthenticated_only',
            'unauthenticated_read_checkouts',
            $GLOBALS['cfg']['store']['shopify']['domain'],
            new FileSessionStorage(),
            ApiVersion::APRIL_2023,
        );

        $this->client = new Storefront(
            $GLOBALS['cfg']['store']['shopify']['domain'],
            $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        );

        $progress = $this->output->createProgressBar();

        Order::where('provider', 'shopify')->whereNotNull('reference')->chunkById(1000, function (Collection $chunk) use ($progress) {
            $ordersById = $chunk->keyBy('order_id');
            $ids = $chunk->map(fn ($order) => $this->getCheckoutId($order->reference))->filter();
            $idChunks = $ids->chunk(10);

            foreach ($idChunks as $idChunk) {
                // values() because laravel uses preserve_keys: true ...
                $body = $this->queryCheckoutIds($idChunk->values());

                $errors = $body['errors'] ?? null;
                $nodes = $body['data']['nodes'] ?? null;

                if ($errors !== null) {
                    $this->error($this->printableResponse($errors));
                }

                foreach ($nodes as $node) {
                    // nodes appear to be returned in order of values queried, including nulls set for not found
                    if ($node !== null) {
                        $orderId = static::getOrderIdFromNode($node);
                        if ($orderId !== null) {
                            $this->line("Updating Order {$orderId}.");
                            $order = $ordersById[$orderId];
                            $order->getConnection()->transaction(function () use ($node, $order) {
                                $orderNode = $node['order'];

                                $params = [
                                    'transaction_id' => Order::PROVIDER_SHOPIFY.'-'.$orderNode['orderNumber'],
                                    'reference' => $orderNode['id'],
                                    'shopify_url' => $orderNode['statusUrl'],
                                ];

                                if ($orderNode['canceledAt'] !== null) {
                                    $params['status'] = 'cancelled';
                                } elseif ($orderNode['fulfillmentStatus'] === 'FULFILLED') {
                                    $params['status'] = 'shipped';
                                } elseif ($orderNode['financialStatus'] === 'PAID') {
                                    $params['status'] = 'paid';
                                }

                                $order->update($params);
                                Payment::where('order_id', $order->getKey())->update(['transaction_id' => $orderNode['orderNumber']]);
                            });

                            $progress->advance();
                        }
                    }
                }

                sleep(1);
            }
        });

        return;
    }

    private function getCheckoutId(string $value): ?string
    {
        if (str_starts_with($value, 'gid://shopify/Checkout')) {
            return $value;
        }

        // other values maybe base64 or already converted to non-gids
        $decoded = base64_decode($value, true);

        $return = $decoded === false
            ? null
            : (str_starts_with($decoded, 'gid://shopify/Checkout')
                ? $decoded
                : null);

        return $return;
    }

    /**
     * Query will return a completely misleading error if there are ids that don't match the node type.
     */
    private function queryCheckoutIds(Collection $ids)
    {
        $query = <<<QUERY
        {
            nodes(ids: {$ids}) {
                ... on Checkout {
                    id
                    customAttributes {
                        key
                        value
                    }
                    order {
                        canceledAt
                        financialStatus
                        fulfillmentStatus
                        id
                        statusUrl
                        orderNumber
                    }
                }
            }
        }
        QUERY;

        return $this->client->query($query)->getDecodedBody();
    }

    private function printableResponse($value)
    {
        return is_array($value) ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $value;
    }
}
