<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

abstract class ExtraDataBase
{
    public static function toExtraDataClass(array $data)
    {
        // avoid using data from the model, they might not be set when this is called.
        $type = $data['type'] ?? static::guessType($data);

        return match ($type) {
            'supporter-tag' => new ExtraDataSupporterTag($data),
            'cwc-supporter',
            'mwc4-supporter',
            'mwc7-supporter',
            'owc-supporter',
            'twc-supporter',
            'tournament' => new ExtraDataTournamentBanner($data),
            default => null,
        };
    }

    private static function guessType(array $data)
    {
        if (isset($data['target_id']) && isset($data['duration'])) {
            return 'supporter-tag';
        }

        // we know it's some kind of tournament...just not which one
        if (isset($data['tournament_id']) && isset($data['cc'])) {
            return 'tournament';
        }

        return null;
    }
}
