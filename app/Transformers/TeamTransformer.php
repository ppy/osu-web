<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\DeletedUser;
use App\Models\Team;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;

class TeamTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'empty_slots',
        'leader',
        'members',
        'statistics',
    ];

    protected int $rulesetId;

    public function setRulesetId(int $rulesetId): static
    {
        $this->rulesetId = $rulesetId;

        return $this;
    }

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

    public function includeMembers(Team $team): Collection
    {
        $users = [];

        foreach ($team->members->sortBy('user.username', SORT_STRING | SORT_FLAG_CASE) as $member) {
            $user = $member->userOrDeleted();

            if ($user instanceof DeletedUser || $user->user_id === $team->leader_id) {
                continue;
            }

            $users[] = $user;
        }

        return $this->collection(
            $users,
            new UserCompactTransformer(),
        );
    }

    public function includeStatistics(Team $team): Item
    {
        return $this->item($team->statistics()->firstOrNew(['ruleset_id' => $this->rulesetId]), new TeamStatisticsTransformer());
    }
}
