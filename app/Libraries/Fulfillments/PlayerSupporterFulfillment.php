<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Models\Store\OrderItem;

class PlayerSupporterFulfillment extends BannerFulfillment
{
    const TAGGED_NAME = 'player-supporter';

    protected function applyBanner(OrderItem $orderItem)
    {
        $product = $orderItem->product;
        $data = $product->typeMappings()[$product->getKey()];
        $orderItem->order->user->profileBanners()->create([
            'tournament_id' => $data['tournament_id'],
            'country_acronym' => $data['player'],
        ]);
    }

    protected function revokeBanner(OrderItem $orderItem)
    {
        $product = $orderItem->product;
        $data = $product->typeMappings()[$product->getKey()];
        // just any matching banner
        $orderItem->order->user
            ->profileBanners()
            ->where('tournament_id', $data['tournament_id'])
            ->where('country_acronym', $data['player'])
            ->first()
            ?->delete();
    }
}
