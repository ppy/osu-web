<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Models\ScorePin;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RenumberUserScorePins implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function __construct(private int $userId, private string $scoreType)
    {
    }

    public function handle()
    {
        DB::transaction(function () {
            $pins = ScorePin
                ::where([
                    'score_type' => $this->scoreType,
                    'user_id' => $this->userId,
                ])->orderBy('display_order', 'asc')
                ->lockForUpdate()
                ->get();

            $currentOrder = -1500;
            $orderInterval = 200;

            foreach ($pins as $pin) {
                $pin->update(['display_order' => $currentOrder]);
                $currentOrder += $orderInterval;
            }
        });
    }
}
