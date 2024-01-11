<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserContestEntry;

class SeasonalBackgroundTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'user',
    ];

    protected array $defaultIncludes = [
        'user',
    ];

    public function transform(UserContestEntry $entry)
    {
        return [
            'url' => $entry->seasonalUrl(),
        ];
    }

    public function includeUser(UserContestEntry $entry)
    {
        return $this->item($entry->user, new UserCompactTransformer());
    }
}
