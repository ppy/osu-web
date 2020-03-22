<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\RankHistory;

class RankHistoryTransformer extends TransformerAbstract
{
    public function transform(RankHistory $rankHistory)
    {
        return [
            'mode' => $rankHistory->mode,
            'data' => $rankHistory->data,
        ];
    }
}
