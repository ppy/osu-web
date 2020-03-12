<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserReplaysWatchedCount;

class UserReplaysWatchedCountTransformer extends TransformerAbstract
{
    public function transform(UserReplaysWatchedCount $count)
    {
        return [
            'start_date' => json_date($count->startDate()),
            'count' => $count->count,
        ];
    }
}
