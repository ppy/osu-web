<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Team;

class TeamTransformer extends TeamCompactTransformer
{
    protected array $defaultIncludes = [
        'leader',
        'members_count',
        'empty_slots',
    ];

    public function transform(Team $team): array
    {
        return [
            ...parent::transform($team),
            'cover_url' => $team->header()->url(),
            'default_ruleset_id' => $team->default_ruleset_id,
            'created_at' => json_time($team->created_at),
            'description' => $team->description,
        ];
    }
}
