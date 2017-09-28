<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries\Fulfillments;

use App\Models\Country;
use App\Models\Store\OrderItem;

/**
 * Base class for Tournament supporter banner order item fulfillment.
 */
abstract class BannerFulfillment extends OrderFulfiller
{
    protected $orderItems;
    const ALLOWED_CUSTOM_CLASS_NAMES = [
        'owc-supporter',
        'mwc7-supporter',
        'twc-supporter',
        'cwc-supporter',
        'mwc4-supporter'
    ];
    const CUSTOM_CLASS_NAME = null;

    public function run()
    {
        $orderItems = $this->getOrderItems();
        foreach ($orderItems as $orderItem) {
            $this->applyBanner($orderItem);
        }
    }

    public function revoke()
    {
        $orderItems = $this->getOrderItems();
        foreach ($orderItems as $orderItem) {
            $this->revokeBanner($orderItem);
        }
    }

    public function taggedName()
    {
        return static::CUSTOM_CLASS_NAME;
    }

    protected function getOrderItems()
    {
        if (!isset($this->orderItems)) {
            if (!in_array(static::CUSTOM_CLASS_NAME, self::ALLOWED_CUSTOM_CLASS_NAMES, true)) {
                $customClassName = static::CUSTOM_CLASS_NAME;
                throw new InvalidFulfillerException("customClass {$customClassName} is not allowed");
            }

            $this->orderItems = $this->getOrder()->items()->customClass(static::CUSTOM_CLASS_NAME)->get();
        }

        return $this->orderItems;
    }

    private function applyBanner(OrderItem $orderItem)
    {
        $extraData = $orderItem->extra_data;
        $user = $orderItem->order->user;
        $user->profileBanners()->create([
            'tournament_id' => $extraData['tournament_id'],
            'country_acronym' => $extraData['cc'],
        ]);
    }

    private function revokeBanner(OrderItem $orderItem)
    {
        $extraData = $orderItem->extra_data;
        $user = $orderItem->order->user;

        // just any matching banner
        $banner = $user
            ->profileBanners()
            ->where('tournament_id', $extraData['tournament_id'])
            ->where('country_acronym', $extraData['cc'])
            ->first();

        if ($banner) {
            $banner->delete();
        }
    }

    private function getCountryName(OrderItem $orderItem)
    {
        $product = $orderItem->product;

        return preg_split("/\(|\)/", $product->name);
    }

    private function getCountryAcronym(OrderItem $orderItem)
    {
        $countryName = $this->getCountryName($orderItem);

        return Country::where('name', $countryName)->first->acronym;
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
