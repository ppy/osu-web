<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Team;

class TeamTransformer extends TransformerAbstract
{
    public function transform(Team $team): array
    {
        return [
            'flag_url' => $team->logo()->url(),
            'id' => $team->getKey(),
            'name' => $team->name,
            'short_name' => $team->short_name,
        ];
    }
}
