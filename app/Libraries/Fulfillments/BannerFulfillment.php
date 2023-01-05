<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Events\Fulfillments\OrderFulfillerEvent;
use App\Models\Store\OrderItem;

/**
 * Base class for Tournament supporter banner order item fulfillment.
 */
abstract class BannerFulfillment extends OrderFulfiller
{
    protected $orderItems;
    const ALLOWED_TAGGED_NAMES = [
        'owc-supporter',
        'mwc7-supporter',
        'twc-supporter',
        'cwc-supporter',
        'mwc4-supporter',
    ];
    const TAGGED_NAME = null;

    public function run()
    {
        $orderItems = $this->getOrderItems();
        foreach ($orderItems as $orderItem) {
            $this->applyBanner($orderItem);
        }

        event("store.fulfillments.run.{$this->taggedName()}", new OrderFulfillerEvent($this->order));
    }

    public function revoke()
    {
        $orderItems = $this->getOrderItems();
        foreach ($orderItems as $orderItem) {
            $this->revokeBanner($orderItem);
        }

        event("store.fulfillments.revoke.{$this->taggedName()}", new OrderFulfillerEvent($this->order));
    }

    protected function getOrderItems()
    {
        if (!isset($this->orderItems)) {
            if (!in_array(static::TAGGED_NAME, self::ALLOWED_TAGGED_NAMES, true)) {
                $customClassName = static::TAGGED_NAME;
                throw new InvalidFulfillerException("customClass {$customClassName} is not allowed");
            }

            $this->orderItems = $this->getOrder()->items()->customClass(static::TAGGED_NAME)->get();
        }

        return $this->orderItems;
    }

    private function applyBanner(OrderItem $orderItem)
    {
        $extraData = $orderItem->extra_data;
        $user = $orderItem->order->user;
        $user->profileBanners()->create([
            'tournament_id' => $extraData->tournamentId,
            'country_acronym' => $extraData->countryAcronym,
        ]);
    }

    private function revokeBanner(OrderItem $orderItem)
    {
        $extraData = $orderItem->extra_data;
        $user = $orderItem->order->user;

        // just any matching banner
        $banner = $user
            ->profileBanners()
            ->where('tournament_id', $extraData->tournamentId)
            ->where('country_acronym', $extraData->countryAcronym)
            ->first();

        if ($banner) {
            $banner->delete();
        }
    }

    //================
    // Validatable
    //================
    public function validationErrorsTranslationPrefix()
    {
        return 'fulfillments.banner-supporter';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }
}
