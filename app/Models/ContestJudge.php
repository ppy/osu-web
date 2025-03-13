<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Contest $contest
 * @property int $contest_id
 * @property-read User $user
 * @property int $user_id
 */
class ContestJudge extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'contest_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stdDev()
    {
        // TODO: treat missing scores as 0?
        $entryScores = ContestJudgeScore::scoresByEntry()
            ->whereHas(
                'vote',
                fn (Builder $q) => $q->where('user_id', $this->user_id)
                    ->whereHas('entry', fn (Builder $qq) => $qq->where('contest_id', $this->contest_id))
            )->pluck('total');

        return std_dev($entryScores->toArray());
    }
}
