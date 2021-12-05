<?php

namespace App\GraphQL\Resolvers;

use App\Models\UserStatistics;

class UserStatisticsResolver
{
    public function getLevel(UserStatistics\Model $stats)
    {
        return [
            'current' => $stats->currentLevel(),
            'progress' => $stats->currentLevelProgressPercent(),
        ];
    }

    public function getGradeCounts(UserStatistics\Model $stats)
    {
        return [
            'ss' => $stats->x_rank_count,
            'ssh' => $stats->xh_rank_count,
            's' => $stats->s_rank_count,
            'sh' => $stats->sh_rank_count,
            'a' => $stats->a_rank_count,
        ];
    }
}
