<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;
use DB;
use Log;

/**
 * FIXME: should validate donation is a positive value on save.
 *
 * @property int $amount
 * @property bool $cancel
 * @property int $length
 * @property int $target_user_id
 * @property \Carbon\Carbon $timestamp
 * @property string $transaction_id
 * @property int $user_id
 */
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
