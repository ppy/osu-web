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

use App\Events\Fulfillments\OrderFulfillerEvent;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;
use App\Models\User;
use Mail;

class SupporterTagFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'supporter-tag';

    private $fulfillers;
    private $orderItems;
    private $minimumRequired = 0; // do not read this field outside of minimumRequired()

    public function run()
    {
        $this->throwOnFail($this->validateRun());

        $fulfillers = $this->getOrderItemFulfillers();

        foreach ($fulfillers as $fulfiller) {
            $fulfiller->run();
        }

        event("store.fulfillments.run.{$this->taggedName()}", new OrderFulfillerEvent($this->order));

        $this->afterRun();
    }

    public function revoke()
    {
        $fulfillers = $this->getOrderItemFulfillers();

        foreach ($fulfillers as $fulfiller) {
            $fulfiller->revoke();
        }

        event("store.fulfillments.revoke.{$this->taggedName()}", new OrderFulfillerEvent($this->order));
    }

    private function afterRun()
    {
        $items = $this->getOrderItems();
        $donor = $this->order->user;
        $giftees = [];
        $donationTotal = $items->sum('cost');
        $length = 0;

        foreach ($items as $item) {
            $length += (int) $item['extra_data']['duration'];
            $targetId = $item['extra_data']['target_id'];
            $target = User::find($targetId);
            // TODO: warn if user doesn't exist, but don't explode.
            if ($donor->getKey() !== $target->getKey()) {
                $giftees[$targetId] = $target;
            }
        }

        $isGift = count($giftees) !== 0;
        Mail::to($donor->user_email)
            ->queue(new \App\Mail\DonationThanks($donor, $length, $donationTotal, $isGift));

        foreach ($giftees as $giftee) {
            Mail::to($giftee->user_email)
                ->queue(new \App\Mail\SupporterGift($donor, $giftee, $length));
        }
    }

    private function validateRun()
    {
        $this->validationErrors()->reset();

        $donationTotal = $this->getOrderItems()->sum('cost');
        \Log::debug("total: {$donationTotal}, required: {$this->minimumRequired()}");
        if ($donationTotal < $this->minimumRequired()) {
            $this->validationErrors()->addError(
                'order_total',
                '.insufficient_paid',
                ['expected' => $this->minimumRequired(), 'actual' => $donationTotal]
            );
        }

        return $this->validationErrors()->isEmpty();
    }

    private function getOrderItems()
    {
        if (!isset($this->orderItems)) {
            $this->orderItems = $this->order->items()->customClass('supporter-tag')->get();
        }

        return $this->orderItems;
    }

    private function getOrderItemFulfillers()
    {
        if (!isset($this->fulfillers)) {
            $items = $this->getOrderItems();
            $fulfillers = [];
            foreach ($items as $item) {
                $fulfillers[] = $this->createFulfiller($item);
            }

            $this->fulfillers = $fulfillers;
        }

        return $this->fulfillers;
    }

    private function minimumRequired()
    {
        $this->getOrderItemFulfillers();

        return $this->minimumRequired;
    }

    private function createFulfiller(OrderItem $item)
    {
        $extraData = $item['extra_data'];
        $duration = (int) $extraData['duration'];
        $minimum = SupporterTag::getMinimumDonation($duration);

        $this->minimumRequired += $minimum;

        return new ApplySupporterTag($item);
    }

    //================
    // Validatable
    //================
    public function validationErrorsTranslationPrefix()
    {
        return 'fulfillments.supporter_tag';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }
}
