<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Team;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;

class TeamTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'empty_slots',
        'leader',
        'members_count',
    ];

    public function transform(Team $team): array
    {
        return [
            'flag_url' => $team->flag()->url(),
            'id' => $team->getKey(),
            'name' => $team->name,
            'short_name' => $team->short_name,
        ];
    }

    public function includeEmptySlots(Team $team): Primitive
    {
        return $this->primitive($team->emptySlots());
    }

    public function includeLeader(Team $team): Item
    {
        return $this->item($team->leader, new UserCompactTransformer());
    }

    public function includeMembersCount(Team $team): Primitive
    {
        return $this->primitive($team->members()->count());
    }
}
