<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamStatistics extends Model
{
    public $incrementing = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['team_id', 'ruleset_id'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function recalculate(): void
    {
        $userIdsQuery = TeamMember
            ::where('team_id', $this->team_id)
            ->whereHas('user', fn ($q) => $q->default())
            ->select('user_id');
        $userStatisticsQuery = UserStatistics\Model::getClass(Beatmap::modeStr($this->ruleset_id))
            ::whereIn('user_id', $userIdsQuery);

        $statistics = $userStatisticsQuery
            ->clone()
            ->selectRaw('SUM(ranked_score) AS ranked_score, SUM(playcount) AS playcount')
            ->first();

        if ($statistics === null) {
            $this->update([
                'performance' => 0,
                'ranked_score' => 0,
                'play_count' => 0,
            ]);

            return;
        }

        $this->ranked_score = $statistics->ranked_score ?? 0;
        $this->play_count = $statistics->playcount ?? 0;

        $performance = 0;
        $factor = 1.0;

        $userPerformances = $userStatisticsQuery
            ->clone()
            ->select('rank_score')
            ->orderByDesc('rank_score')
            ->limit($GLOBALS['cfg']['osu']['rankings']['country_performance_user_count'])
            ->get();

        foreach ($userPerformances as $userPerformance) {
            $performance += $userPerformance->rank_score * $factor;
            $factor *= $GLOBALS['cfg']['osu']['rankings']['team_performance_weighting_factor'];
        }

        $this->performance = $performance;
        $this->save();
    }
}
