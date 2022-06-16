<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\Beatmapset;
use App\Models\User;

class ProfileBeatmapset
{
    public static function countByGroupedStatus(User $user): array
    {
        return $user
            ->beatmapsets()
            ->active()
            ->selectRaw('COUNT(*) as beatmapset_count, approved')
            ->groupBy('approved')
            ->get()
            ->reduce(function ($carry, $item) {
                static $profileStatus = [
                    Beatmapset::STATES['graveyard'] => 'graveyard',

                    Beatmapset::STATES['loved'] => 'loved',

                    Beatmapset::STATES['pending'] => 'pending',
                    Beatmapset::STATES['wip'] => 'pending',

                    Beatmapset::STATES['approved'] => 'ranked',
                    Beatmapset::STATES['qualified'] => 'ranked',
                    Beatmapset::STATES['ranked'] => 'ranked',
                ];
                $attrs = $item->getAttributes();
                $carry[$profileStatus[$attrs['approved']]] ??= 0;
                $carry[$profileStatus[$attrs['approved']]] += $attrs['beatmapset_count'];

                return $carry;
            }, []);
    }
}
