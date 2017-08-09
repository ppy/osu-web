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

namespace App\Libraries\Fulfillments\Subcommands;

use App\Models\User;
use App\Models\UserDonation;
use Carbon\Carbon;
use DB;

class ApplySupporterTag extends StoreTransactionFulfillment
{
    private $donor;
    private $target;

    private function assignUsers()
    {
        $this->donor = User::findOrFail($this->donorId);
        $this->target = User::findOrFail($this->targetId);
    }
    public function cancelledTransactionId()
    {
        return "{$this->transactionId}-cancel";
    }

    public function run($context)
    {
        DB::transaction(function () use ($context) {
            // check if transaction was already applied.
            if (UserDonation::where('transaction_id', $this->transactionId)->count() > 0) {
                \Log::info("{$this->transactionId} already exists in UserDonations!");
                return;
            }

            $this->assignUsers();

            $donation = $this->applyDonation();
            $this->updateVotes();
            $this->applySubscription();

            $this->donor->supports()->save($donation);
            $this->donor->save();
            $this->target->save();
        });
    }

    public function revoke($context)
    {
        DB::transaction(function () {
            // cancel only if applied.
            if (UserDonation::where('transaction_id', $this->cancelledTransactionId())->count() > 0) {
                \Log::info("{$this->cancelledTransactionId()} already exists in UserDonations!");
                return;
            }

            $donations = UserDonation::where('transaction_id', $this->transactionId)->get();
            if ($donations->count() === 0) {
                \Log::info("{$this->transactionId} nothing to revoke!");
                return;
            }

            $this->assignUsers();

            foreach ($donations as $donation) { // loop, but there should only be one.
                $donation = $this->revokeDonation($donation);
                $this->updateVotes();
                $this->revokeSubscription();

                $donation->save();
                $this->donor->save();
                $this->target->save();
            }
        });
    }

    private function updateVotes()
    {
        $this->donor['osu_featurevotes'] += $this->duration * 2;
    }

    private function applyDonation()
    {
        $donation = new UserDonation();
        $donation['transaction_id'] = $this->transactionId;
        $donation['user_id'] = $this->donorId;
        $donation['target_user_id'] = $this->targetId;
        $donation['length'] = $this->duration;
        $donation['amount'] = $this->amount;

        \Log::debug($donation);

        return $donation;
    }

    private function revokeDonation($donation)
    {
        $reverse = new UserDonation();
        $reverse['transaction_id'] = $this->cancelledTransactionId();
        $reverse['user_id'] = $donation['user_id'];
        $reverse['target_user_id'] = $donation['target_user_id'];
        $reverse['length'] = $donation['length'];
        $amount = $donation['amount'];
        $reverse['amount'] = $amount > 0 ? -$amount : $amount;
        $reverse['cancel'] = true;

        \Log::debug($reverse);

        return $reverse;
    }

    private function applySubscription()
    {
        $old = $this->target['osu_subscriptionexpiry'] === null ? Carbon::now() : Carbon::parse($this->target['osu_subscriptionexpiry']);
        $this->target['osu_subscriptionexpiry'] = $old->addMonths($this->duration);
        $this->target['osu_subscriber'] = true;
    }

    private function revokeSubscription()
    {
        $old = Carbon::parse($this->target['osu_subscriptionexpiry']);
        $this->target['osu_subscriptionexpiry'] = $old->subMonths($this->duration);
        $this->target['osu_subscriber'] = Carbon::now()->diffInMonths($old, false) > 0;
    }
}
