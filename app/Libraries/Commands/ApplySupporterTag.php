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

namespace App\Libraries\Commands;

use App\Models\User;
use App\Models\UserDonation;
use DB;

class ApplySupporterTag extends StoreTransactionFulfillment
{
    public function run()
    {
        DB::transaction(function () {
            // check if transaction was already applied.
            if (UserDonation::where('transaction_id', $this->transactionId)->count() > 0) {
                \Log::info("{$this->transactionId} already exists in UserDonations!");
                return;
            }

            $user = User::findOrFail($this->targetId);
            $userDonation = new UserDonation();
            $userDonation['transaction_id'] = $this->transactionId;
            $userDonation['user_id'] = $this->donorId;
            $userDonation['target_user_id'] = $this->targetId;
            $userDonation['length'] = $this->duration;
            $userDonation['amount'] = $this->amount;

            \Log::debug($userDonation);

            $user->supports()->save($userDonation);
        });
    }

    public function revoke()
    {
        DB::transaction(function () {
            // cancel only if applied.
            if (UserDonation::where('transaction_id', $this->cancelledTransactionId())->count() > 0) {
                \Log::info("{$this->transactionId} already exists in UserDonations!");
                return;
            }

            $donations = UserDonation::where('transaction_id', $this->transactionId)->get();
            if ($donations->count() === 0) {
                \Log::info("{$this->transactionId} nothing to revoke!");
                return;
            }

            foreach ($donations as $donation) {
                $reverse = new UserDonation();
                $reverse['transaction_id'] = $this->cancelledTransactionId();
                $reverse['user_id'] = $donation['user_id'];
                $reverse['target_user_id'] = $donation['target_user_id'];
                $reverse['length'] = $donation['length'];
                $amount = $donation['amount'];
                $reverse['amount'] = $amount > 0 ? -$amount : $amount;
                $reverse['cancel'] = true;

                $reverse->save();
            }
        });
    }

    public function cancelledTransactionId()
    {
        return "{$this->transactionId}-cancel";
    }
}
