<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\MatchmakingUserStats;
use League\Fractal\Resource\ResourceInterface;

class MatchmakingUserStatsTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'pool',
    ];

    public function transform(MatchmakingUserStats $stats): array
    {
        return [
            'first_placements' => $stats->first_placements,
            'pool_id' => $stats->pool_id,
            'rank' => $stats->rank,
            'rating' => $stats->rating,
            'total_points' => $stats->total_points,
            'user_id' => $stats->user_id,
        ];
    }

    public function includePool(MatchmakingUserStats $stats): ResourceInterface
    {
        return $this->item($stats->pool, new MatchmakingPoolTransformer());
    }
}
