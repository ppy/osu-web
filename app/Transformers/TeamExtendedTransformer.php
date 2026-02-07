<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Team;

class TeamExtendedTransformer extends TeamTransformer
{
    protected array $defaultIncludes = [
        'empty_slots',
        'leader',
        'members',
        'statistics',
    ];

    public function transform(Team $team): array
    {
        return [
            ...parent::transform($team),
            'cover_url' => $team->header()->url(),
            'created_at' => json_time($team->created_at),
            'default_ruleset_id' => $team->default_ruleset_id,
            'description' => $team->description,
            'is_open' => $team->is_open,
        ];
    }
}
