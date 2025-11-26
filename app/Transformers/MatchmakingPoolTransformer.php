<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\MatchmakingPool;

class MatchmakingPoolTransformer extends TransformerAbstract
{
    public function transform(MatchmakingPool $pool): array
    {
        return [
            'id' => $pool->getKey(),
            'name' => $pool->name,
            'ruleset_id' => $pool->ruleset_id,
            'variant_id' => $pool->variant_id,
        ];
    }
}
