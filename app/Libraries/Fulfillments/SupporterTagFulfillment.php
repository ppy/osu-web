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

use App\Events\Fulfillments\SupporterTagEvent;
use App\Models\Event;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;
use App\Models\User;
use Log;
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

        event(
            "store.fulfillments.run.{$this->taggedName()}",
            new SupporterTagEvent($this->order, $this->getOrderItems())
        );

        $this->afterRun();
    }

    public function revoke()
    {
        $fulfillers = $this->getOrderItemFulfillers();

        foreach ($fulfillers as $fulfiller) {
            $fulfiller->revoke();
        }

        event(
            "store.fulfillments.revoke.{$this->taggedName()}",
            new SupporterTagEvent($this->order, $this->getOrderItems())
        );
    }

    private function afterRun()
    {
        $items = $this->getOrderItems();
        $donor = $this->order->user;
        $gifts = [];
        $donationTotal = $items->sum('cost');
        $totalDuration = 0;

        foreach ($items as $item) {
            $duration = (int) $item['extra_data']['duration'];
            $totalDuration += $duration;
            $targetId = $item['extra_data']['target_id'];
            $target = User::find($targetId);
            // TODO: warn if user doesn't exist, but don't explode.
            if ($donor->getKey() !== $target->getKey()) {
                if (($gifts[$targetId] ?? null) === null) {
                    $gifts[$targetId] = ['target' => $target, 'duration' => $duration];
                } else {
                    $gifts[$targetId]['duration'] += $duration;
                }
            }
        }

        $isGift = count($gifts) !== 0;

        Event::generate(
            $donor->hasSupported() ? 'userSupportAgain' : 'userSupportFirst',
            ['user' => $donor, 'date' => $this->order->paid_at]
        );

        if (present($donor->user_email)) {
            Mail::to($donor->user_email)
                ->queue(new \App\Mail\DonationThanks($donor, $totalDuration, $donationTotal, $isGift));
        } else {
            Log::warning("User ({$$donor->getKey()}) does not have an email address set!");
        }

        foreach ($gifts as $_key => $value) {
            $giftee = $value['target'];
            Event::generate('userSupportGift', ['user' => $giftee, 'date' => $this->order->paid_at]);

            if (present($giftee->user_email)) {
                Mail::to($giftee->user_email)
                    ->queue(new \App\Mail\SupporterGift($donor, $giftee, $value['duration']));
            } else {
                Log::warning("User ({$giftee->getKey()}) does not have an email address set!");
            }
        }
    }

    private function validateRun()
    {
        $this->validationErrors()->reset();

        $donationTotal = $this->getOrderItems()->sum('cost');
        Log::debug("total: {$donationTotal}, required: {$this->minimumRequired()}");
        if ($donationTotal < $this->minimumRequired()) {
            $this->validationErrors()->add(
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
