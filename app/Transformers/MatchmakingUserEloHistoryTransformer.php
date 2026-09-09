<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\MatchmakingUserEloHistory;

class MatchmakingUserEloHistoryTransformer extends TransformerAbstract
{
    public function transform(MatchmakingUserEloHistory $history): array
    {
        return [
            'elo_after' => $history->elo_after,
            'id' => $history->getKey(),
            'result' => $history->result,
            'created_at' => json_time($history->created_at),
        ];
    }
}
