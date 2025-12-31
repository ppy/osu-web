<?php

namespace App\Transformers;

use App\Models\Team;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;

class TeamCompactTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'leader',
        'members_count',
        'empty_slots',
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

    public function includeLeader(Team $team): Item
    {
        return $this->item($team->leader, new UserCompactTransformer());
    }

    public function includeMembersCount(Team $team): Primitive
    {
        return $this->primitive($team->members()->count());
    }

    public function includeEmptySlots(Team $team): Primitive
    {
        return $this->primitive($team->emptySlots());
    }
}
