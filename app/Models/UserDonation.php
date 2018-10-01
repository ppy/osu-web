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

namespace App\Models;

use Carbon\Carbon;
use DB;
use Log;

// FIXME: should validate donation is a positive value on save.
class UserDonation extends Model
{
    protected $table = 'osu_user_donations';

    protected $dates = ['timestamp'];

    public $timestamps = false;

    protected $casts = [
        'cancel' => 'boolean',
    ];

    public static function totalLength($userId)
    {
        $lengths = static::where('target_user_id', $userId)
            ->select('cancel', DB::raw('SUM(length) as length'))
            ->groupBy('cancel')
            ->get();

        $totalLength = 0;

        foreach ($lengths as $length) {
            if ($length->cancel !== true) {
                $totalLength += $length->length;
            } else {
                $totalLength -= $length->length;
            }
        }

        return $totalLength;
    }

    public function cancel($cancelledTransactionId)
    {
        if ($this->cancel) {
            Log::warning("UserDonation({$this->getKey()}) Calling cancel on a cancelled donation");

            return;
        }

        $donation = $this->replicate();
        $donation->transaction_id = $cancelledTransactionId;
        $donation->amount = -$donation->amount;
        $donation->cancel = true;
        $donation->timestamp = Carbon::now();

        Log::debug($donation);

        $donation->saveOrExplode();
    }
}
