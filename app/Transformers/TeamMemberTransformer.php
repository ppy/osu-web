<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\TeamMember;
use League\Fractal\Resource\Item;

class TeamMemberTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['user'];

    protected array $defaultIncludes = ['user'];

    public function transform(TeamMember $member): array
    {
        return [
            'created_at' => json_time($member->created_at),
        ];
    }

    public function includeUser(TeamMember $member): Item
    {
        return $this->item($member->user, new UserCompactTransformer());
    }
}
