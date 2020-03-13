<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Models\User;
use App\Models\UserDonation;
use Carbon\Carbon;
use DB;

/**
 * Applies a Supporter Tag donation from a store transaction.
 */
class ApplySupporterTag extends OrderItemFulfillment
{
    private $donor;
    private $target;

    private $donorId;
    private $targetId;
    private $duration;
    private $amount;

    public function __construct($orderItem)
    {
        parent::__construct($orderItem);
        $this->donorId = $orderItem->order->user_id;
        $this->targetId = $orderItem->extra_data['target_id'];
        $this->duration = (int) $orderItem->extra_data['duration'];
        $this->amount = $orderItem->cost;
    }

    private function assignUsers()
    {
        $this->donor = User::findOrFail($this->donorId);
        $this->target = User::findOrFail($this->targetId);
    }

    public function cancelledTransactionId()
    {
        return "{$this->getTransactionId()}-cancel";
    }

    /**
     * Performs the opration.
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException If the donor or target could not be found.
     */
    public function run()
    {
        DB::transaction(function () {
            // check if transaction was already applied.
            if (UserDonation::where('transaction_id', $this->getTransactionId())->count() > 0) {
                \Log::info("{$this->getTransactionId()} already exists in UserDonations!");

                return;
            }

            $this->assignUsers();

            $donation = $this->applyDonation();
            $this->updateVotes($this->duration);
            $this->applySubscription();

            $donation->saveOrExplode();
            $this->donor->saveOrExplode();
            $this->target->saveOrExplode();
        });
    }

    /**
     * Revokes the operation.
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException If the donor or target could not be found.
     */
    public function revoke()
    {
        DB::transaction(function () {
            // cancel only if applied.
            if (UserDonation::where('transaction_id', $this->cancelledTransactionId())->count() > 0) {
                \Log::info("{$this->cancelledTransactionId()} already exists in UserDonations!");

                return;
            }

            $donations = UserDonation::where('transaction_id', $this->getTransactionId())->get();
            if ($donations->count() === 0) {
                \Log::info("{$this->getTransactionId()} nothing to revoke!");

                return;
            }

            $this->assignUsers();

            foreach ($donations as $donation) { // loop, but there should only be one.
                $donation->cancel($this->cancelledTransactionId());
                $this->updateVotes(-$this->duration);
                $this->revokeSubscription();

                $this->donor->saveOrExplode();
                $this->target->saveOrExplode();
            }
        });
    }

    private function updateVotes($duration)
    {
        $this->donor->osu_featurevotes += $duration * 2;
    }

    private function applyDonation()
    {
        return new UserDonation([
            'transaction_id' => $this->getTransactionId(),
            'user_id' => $this->donorId,
            'target_user_id' => $this->targetId,
            'length' => $this->duration,
            'amount' => $this->amount,
        ]);
    }

    private function applySubscription()
    {
        // start fresh if was an existing subscriber and expired.
        // null < $now = true.
        $now = Carbon::now();
        $old = $this->target->osu_subscriptionexpiry < $now ? $now : $this->target->osu_subscriptionexpiry;
        $this->target->osu_subscriptionexpiry = $old->addMonthsNoOverflow($this->duration);
        $this->target->osu_subscriber = true;
    }

    private function revokeSubscription()
    {
        $old = $this->target->osu_subscriptionexpiry;
        $this->target->osu_subscriptionexpiry = $old->subMonthsNoOverflow($this->duration);
        $this->target->osu_subscriber = Carbon::now()->diffInMinutes($old, false) > 0;
    }
}
