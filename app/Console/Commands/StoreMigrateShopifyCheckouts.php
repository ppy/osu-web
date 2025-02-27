<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Libraries\Store\ShopifyOrder;
use App\Models\Store\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Shopify\Clients\Storefront;
use Symfony\Component\Console\Helper\ProgressBar;

class StoreMigrateShopifyCheckouts extends Command
{
    private const PROGRESS_BARS = [
        'orders' => 'Orders read',
        'gids' => 'Response nodes processed',
        'updated' => 'Orders updated',
    ];

    protected $signature = 'store:migrate-shopify-checkouts';

    protected $description = 'Migrates Shopify orders using Checkout ids to the Order or Cart ids.';

    private Storefront $client;
    /** @var ProgressBar[]  */
    private array $progress;

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
        $this->client = ShopifyOrder::storefontClient('unauthenticated_read_checkouts');

        /** @var \Symfony\Component\Console\Output\ConsoleOutput $output */
        $output = $this->output->getOutput();

        foreach (static::PROGRESS_BARS as $name => $description) {
            $progress = new ProgressBar($output->section());
            $progress->setFormat("%current% {$description} | %message%");
            $progress->setMessage('');
            $progress->start();

            $this->progress[$name] = $progress;
        }

        $result = Order::where('provider', 'shopify')->whereNotNull('reference')->chunkById(1000, function (Collection $chunk) {
            $ordersById = $chunk->map(fn (Order $order) => new ShopifyOrder($order))->keyBy('order.order_id');
            $this->progress['orders']->advance(count($ordersById));

            $ids = $ordersById->values()->map(fn (ShopifyOrder $order) => $order->getCheckoutId())->filter();
            $idChunks = $ids->chunk(100);

            foreach ($idChunks as $idChunk) {
                // values() because laravel uses preserve_keys: true ...
                $body = $this->queryCheckoutIds($idChunk->values());

                $errors = $body['errors'] ?? null;

                if ($errors !== null) {
                    $this->error($this->printableResponse($errors));

                    foreach ($this->progress as $progress) {
                        $progress->display();
                    }

                    return false;
                }

                $nodes = $body['data']['nodes'];
                foreach ($nodes as $node) {
                    $this->progress['gids']->advance();
                    $this->progress['gids']->setMessage($node['id'] ?? 'null');
                    // nodes appear to be returned in order of values queried, including nulls set for not found
                    if ($node !== null) {
                        $orderId = static::getOrderIdFromNode($node);
                        if ($orderId !== null) {
                            $order = $ordersById[$orderId];
                            if (isset($node['order'])) {
                                $order->updateOrderWithGql($node['order']);
                            } else {
                                // orders that haven't completed checkout.
                                $order->order->update(['shopify_url' => $node['webUrl']]);
                            }

                            $this->progress['updated']->advance();
                            $this->progress['updated']->setMessage((string) $orderId);
                        }
                    }
                }

                sleep(1);
            }
        });

        if (!$result) {
            return static::FAILURE;
        }

        foreach ($this->progress as $progress) {
            $progress->display();
            $progress->finish();
        }
    }

    /**
     * Query will return a completely misleading error if there are ids that don't match the node type.
     */
    private function queryCheckoutIds(Collection $ids)
    {
        $query = <<<QUERY
        {
            nodes(ids: {$ids->toJson(JSON_UNESCAPED_SLASHES)}) {
                ... on Checkout {
                    id
                    webUrl
                    customAttributes {
                        key
                        value
                    }
                    order {
                        canceledAt
                        financialStatus
                        fulfillmentStatus
                        id
                        orderNumber
                        processedAt
                        statusUrl
                        billingAddress {
                            countryCodeV2
                        }
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
