<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Shopify\ApiVersion;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Storefront;
use Shopify\Context;

class Shopify
{
    public static function gidType(string $gid): ?string {
        return match (true) {
            str_starts_with($gid, 'gid://shopify/Cart') => 'Cart',
            str_starts_with($gid, 'gid://shopify/Checkout') => 'Checkout',
            str_starts_with($gid, 'gid://shopify/Order') => 'Order',
            default => null,
        };
    }

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
}
