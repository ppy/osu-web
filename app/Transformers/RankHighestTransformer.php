<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\RankHighest;

class RankHighestTransformer extends TransformerAbstract
{
    public function transform(RankHighest $rankHighest): array
    {
        return [
            'rank' => $rankHighest->rank,
            'updated_at' => $rankHighest->updated_at_json,
        ];
    }
}
