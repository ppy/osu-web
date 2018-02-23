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
