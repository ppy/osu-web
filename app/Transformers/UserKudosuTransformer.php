<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\User;
use League\Fractal\Resource\ResourceInterface;

class UserKudosuTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'rank',
    ];

    public function transform(User $user): array
    {
        return [
            'available' => $user->osu_kudosavailable,
            'total' => $user->osu_kudostotal,
        ];
    }

    public function includeRank(User $user): ResourceInterface
    {
        return $this->primitive($user->kudosuRank());
    }
}
