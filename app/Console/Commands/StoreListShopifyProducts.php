<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Shopify\ApiVersion;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Storefront;
use Shopify\Context;

class StoreListShopifyProducts extends Command
{
    protected $description = 'List Products from Shopify';
    protected $signature = 'store:list-shopify-products';

    public function handle()
    {
        Context::initialize(
            // public unauthenticated Storefront API doesn't need OAuth and we can't use blanks.
            'unauthenticated_only',
            'unauthenticated_only',
            'unauthenticated_read_product_listings',
            $GLOBALS['cfg']['store']['shopify']['domain'],
            new FileSessionStorage(),
            ApiVersion::APRIL_2024,
        );

        $client = new Storefront(
            $GLOBALS['cfg']['store']['shopify']['domain'],
            $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        );

        // just hope we never have more than 100 products or variants.
        $query = <<<QUERY
        {
            products(first: 100, sortKey: ID) {
                edges {
                    node {
                        id
                        title
                        variants(first: 100, sortKey: ID) {
                            edges {
                                node {
                                    id
                                    title
                                }
                            }
                        }
                    }
                }
            }
        }
        QUERY;

        $body = $client->query($query)->getDecodedBody() ?? '';
        $this->line(is_array($body) ? json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $body);
    }
}
