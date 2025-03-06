<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamStatistics extends Model
{
    private const DEFAULT_ATTRIBUTES = [
        'performance' => 0,
        'play_count' => 0,
        'ranked_score' => 0,
    ];

    public $incrementing = false;

    protected $attributes = self::DEFAULT_ATTRIBUTES;
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['team_id', 'ruleset_id'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class, 'team_id', 'team_id');
    }

    public function getRank(): int
    {
        return 1 + static
            ::where('ruleset_id', $this->ruleset_id)
            ->where('performance', '>', $this->performance)
            ->count();
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
            $this->update(static::DEFAULT_ATTRIBUTES);

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
