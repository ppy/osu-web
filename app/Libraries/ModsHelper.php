<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class ModsHelper
{
    const AVAILABLE_MODS = [
        [0, 'NF'],
        [1, 'EZ'],
        [3, 'HD'],
        [20, 'FI'],
        [4, 'HR'],
        [9, 'NC', [6]],
        [6, 'DT'],
        [7, 'RX'],
        [8, 'HT'],
        [10, 'FL'],
        [12, 'SO'],
        [13, 'AP'],
        [14, 'PF', [5]],
        [5, 'SD'],
        [2, 'TD'],
        [30, 'MR'],

        // mania keys (converts)
        [15, '4K'],
        [16, '5K'],
        [17, '6K'],
        [18, '7K'],
        [19, '8K'],
        [24, '9K'],

        [29, 'V2'],
    ];
    const DIFFICULTY_REDUCTION_MODS = ['NF', 'EZ', 'HT', 'SO'];
    const PREFERENCE_MODS_BITSET = 0b01000000000000000100001000100000; // SD, NC, PF, MR

    public static function toArray($bitset)
    {
        $mods = [];
        $impliedIds = [];

        foreach (static::AVAILABLE_MODS as $availableMod) {
            if (($bitset & (1 << $availableMod[0])) === 0) {
                continue;
            }

            $currentImpliedIds = $availableMod[2] ?? null;
            if ($currentImpliedIds !== null) {
                $impliedIds = array_merge($impliedIds, $currentImpliedIds);
            }

            $mods[$availableMod[0]] = $availableMod[1];
        }

        $mods = array_filter($mods, function ($modId) use ($impliedIds) {
            return !in_array($modId, $impliedIds, true);
        }, ARRAY_FILTER_USE_KEY);

        return array_values($mods);
    }

    public static function toBitset($mods)
    {
        if (!is_array($mods)) {
            return 0;
        }

        $bitset = 0;

        foreach (static::AVAILABLE_MODS as $availableMod) {
            if (in_array($availableMod[1], $mods, true)) {
                $bitset |= (1 << $availableMod[0]);

                if (isset($availableMod[2])) {
                    foreach ($availableMod[2] as $implicitMod) {
                        $bitset |= (1 << $implicitMod);
                    }
                }
            }
        }

        return $bitset;
    }
}
