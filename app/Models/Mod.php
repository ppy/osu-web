<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Models;

class Mod
{
    const AVAILABLE_MODS = [
        [0, 'No Fail', 'NF'],
        [1, 'Easy Mode', 'EZ'],
        [3, 'Hidden', 'HD'],
        [4, 'Hard Rock', 'HR'],
        [5, 'Sudden Death', 'SD', [14]],
        [6, 'Double Time', 'DT'],
        [7, 'Relax', 'Relax'],
        [8, 'Half Time', 'HT'],
        [9, 'Nightcore', 'NC', [6]],
        [10, 'Flashlight', 'FL'],
        [12, 'Spun Out', 'SO'],
        [13, 'Auto Pilot', 'AP'],
        [14, 'Perfect', 'PF'],
        [15, '4K', '4K'],
        [16, '5K', '5K'],
        [17, '6K', '6K'],
        [18, '7K', '7K'],
        [19, '8K', '8K'],
        [20, 'Fade In', 'FI'],
        [24, '9K', '9K'],
    ];

    public static function getEnabledMods($mods)
    {
        $enabledMods = [];
        $impliedIds = [];

        foreach (self::AVAILABLE_MODS as $availableMod) {
            if (($mods & (1 << $availableMod[0])) === 0) {
                continue;
            }

            $currentImpliedIds = array_get($availableMod, 3);
            if ($currentImpliedIds !== null) {
                $impliedIds = array_merge($impliedIds, $currentImpliedIds);
            }

            $enabledMods[$availableMod[0]] = ['name' => $availableMod[1], 'shortName' => $availableMod[2]];
        }

        $enabledMods = array_filter($enabledMods, function ($modId) use ($impliedIds) {
            return in_array($modId, $impliedIds, true) === false;
        }, ARRAY_FILTER_USE_KEY);

        return array_values($enabledMods);
    }
}
