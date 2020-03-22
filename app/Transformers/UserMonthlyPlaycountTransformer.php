<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserMonthlyPlaycount;

class UserMonthlyPlaycountTransformer extends TransformerAbstract
{
    public function transform(UserMonthlyPlaycount $playcount)
    {
        return [
            'start_date' => json_date($playcount->startDate()),
            'count' => $playcount->playcount,
        ];
    }
}
