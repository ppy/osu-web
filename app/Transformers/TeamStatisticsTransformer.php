<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\TeamStatistics;
use League\Fractal\Resource\Primitive;

class TeamStatisticsTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['rank', 'member_count', 'team'];

    public function transform(TeamStatistics $stat)
    {
        return [
            'team_id' => $stat->team_id,
            'ruleset_id' => $stat->ruleset_id,
            'play_count' => $stat->play_count,
            'ranked_score' => $stat->ranked_score,
            'performance' => $stat->performance,
        ];
    }

    public function includeRank(TeamStatistics $stat): Primitive
    {
        return $this->primitive($stat->getRank());
    }

    public function includeTeam(TeamStatistics $stat)
    {
        return $this->item($stat->team, new TeamCompactTransformer());
    }

    public function includeMemberCount(TeamStatistics $stat)
    {
        return $this->primitive($stat->members_count);
    }
}
