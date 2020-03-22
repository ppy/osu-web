<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BuildPropagationHistory;

class BuildHistoryChartTransformer extends TransformerAbstract
{
    public function transform(BuildPropagationHistory $entry)
    {
        // $entry is output of ::changelog.
        return [
            'created_at' => json_time($entry->created_at),
            'user_count' => $entry->user_count,
            'label' => $entry->label,
        ];
    }
}
