<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        [7, 'Relax'],
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
    ];

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
