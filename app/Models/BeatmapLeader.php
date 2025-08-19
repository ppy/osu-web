<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Solo\Score;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $ruleset_id
 * @property int $beatmap_id
 * @property int $user_id
 * @property int $score_id
 */
class BeatmapLeader extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'score_id';

    public function scopeRuleset(Builder $query, string $ruleset): Builder
    {
        return $query
            ->whereHas('beatmap.beatmapset')
            ->whereHas('score')
            ->where('ruleset_id', '=', Beatmap::modeInt($ruleset));
    }

    public function beatmap(): BelongsTo
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id', 'id');
    }

    public static function sync(int $beatmapId, int $rulesetId): void
    {
        $searchParams = ScoreSearchParams::fromArray([
            'beatmap_ids' => [$beatmapId],
            'is_legacy' => false,
            'limit' => 1,
            'ruleset_id' => $rulesetId,
            'sort' => 'score_desc',
        ]);

        $score = (new ScoreSearch($searchParams))->records()->first();

        DB::transaction(function () use ($beatmapId, $rulesetId, $score): void {
            $scoreLeader = static::where([
                'beatmap_id' => $beatmapId,
                'ruleset_id' => $rulesetId,
            ])->lockForUpdate()->first();

            if ($score === null) {
                $scoreLeader?->delete();

                return;
            }

            $params = [
                'beatmap_id' => $beatmapId,
                'ruleset_id' => $rulesetId,
                'score_id' => $score->getKey(),
                'user_id' => $score->user_id,
            ];

            if ($scoreLeader === null) {
                static::create($params);
            } else {
                $scoreLeader->update($params);
            }
        });
    }
}
