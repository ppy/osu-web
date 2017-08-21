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

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;
use App\Models\User;
use Mail;

class SupporterTagFulfillment extends OrderFulfiller
{
    private $minimumRequired = 0; // do not read this field outside of minimumRequired()
    private $fulfillers;

    private $orderItems;

    public function run()
    {
        $this->throwOnFail($this->validateRun());

        $fulfillers = $this->getOrderItemFulfillers();

        foreach ($fulfillers as $fulfiller) {
            $fulfiller->run();
        }
    }

    public function revoke()
    {
        $fulfillers = $this->getOrderItemFulfillers();

        foreach ($fulfillers as $fulfiller) {
            $fulfiller->revoke();
        }
    }

    public function afterRun()
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
            if ($donor->getKey() != $target->getKey()) {
                $giftees[$targetId] = $target;
            }
        }

        \Log::debug("send donation thanks to {$donor->user_email}");
        Mail::to($donor->user_email)
            ->queue(new \App\Mail\DonationThanks($donor, $length, $donationTotal));

        foreach ($giftees as $giftee) {
            \Log::debug("send gift thanks to {$giftee->user_email}");
            Mail::to($giftee->user_email)
                ->queue(new \App\Mail\SupporterGift($donor, $giftee, $length));
        }
    }

    private function validateRun()
    {
        $this->validationErrors()->reset();

        \Log::debug("total: {$this->order->getTotal()}, required: {$this->minimumRequired()}");
        if ($this->order->getTotal() < $this->minimumRequired()) {
            $this->validationErrors()->addError(
                'order_total',
                '.insufficient_paid'
            );
        };

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
            \Log::debug($items);
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
        $targetId = (int) $extraData['target_id'];
        $duration = (int) $extraData['duration'];
        $minimum = SupporterTag::getMinimumDonation($duration);

        $this->minimumRequired += $minimum;

        $params = [
            'donorId' => $this->order['user_id'],
            'targetId' => $targetId,
            'duration' => $duration,
            'amount' => $item['cost'],
        ];

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

    //================
    // OrderFulfiller
    //================
    protected function eventForValidationError()
    {
        return new ValidationFailedEvent($this->validationErrors(), 'supporter-tag');
    }
}
