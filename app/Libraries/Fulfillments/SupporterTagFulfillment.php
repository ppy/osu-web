<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Events\Fulfillments\SupporterTagEvent;
use App\Models\Event;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Log;
use Mail;

class SupporterTagFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'supporter-tag';

    private $continued;
    private $fulfillers;
    private int $minimumRequired = 0; // do not read this field outside of minimumRequired()
    private ?Collection $orderItems;

    public function run()
    {
        $this->throwOnFail($this->validateRun());

        $this->continued = $this->order->user->supporterTagPurchases()->exists();
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
            $extraData = $item->extra_data;

            $duration = $extraData->duration;
            $totalDuration += $duration;

            $targetId = $extraData->targetId;
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
            $this->continued ? 'userSupportAgain' : 'userSupportFirst',
            ['user' => $donor, 'date' => $this->order->paid_at]
        );

        if (present($donor->user_email)) {
            Mail::to($donor)
                ->queue(new \App\Mail\DonationThanks($donor, $totalDuration, $donationTotal, $isGift, $this->continued));
        } else {
            Log::warning("User ({$$donor->getKey()}) does not have an email address set!");
        }

        foreach ($gifts as $_key => $value) {
            $giftee = $value['target'];
            Event::generate('userSupportGift', ['user' => $giftee, 'date' => $this->order->paid_at]);

            if (present($giftee->user_email)) {
                Mail::to($giftee)
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

    /**
     * @return Collection<OrderItem>
     */
    private function getOrderItems(): Collection
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
        $this->minimumRequired += SupporterTag::getMinimumDonation($item->extra_data->duration);

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
