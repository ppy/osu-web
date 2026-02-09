<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ScoreReplayStats;
use League\Fractal\Resource\ResourceInterface;

class ScoreReplayStatsTransformer extends TransformerAbstract
{
    // Like ScoreTransformer::USER_PROFILE_INCLUDES but without user
    const USER_PROFILE_INCLUDES = ['score.beatmap', 'score.beatmapset'];
    const USER_PROFILE_INCLUDES_PRELOAD = ['score.beatmap.beatmapset'];

    protected array $availableIncludes = [
        'score',
    ];

    public function transform(ScoreReplayStats $stats): array
    {
        return [
            'score_id' => $stats->score_id,
            'watch_count' => $stats->watch_count,
        ];
    }

    public function includeScore(ScoreReplayStats $stats): ResourceInterface
    {
        return $this->item($stats->score, new ScoreTransformer());
    }
}
