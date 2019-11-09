<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries\Multiplayer;

use App\Exceptions\InvariantException;

class Mod
{
    // common
    const DAYCORE = 'DC';
    const DOUBLETIME = 'DT';
    const EASY = 'EZ';
    const FLASHLIGHT = 'FL';
    const HIDDEN = 'HD';
    const HARDROCK = 'HR';
    const HALFTIME = 'HT';
    const NIGHTCORE = 'NC';
    const NOFAIL = 'NF';
    const PERFECT = 'PF';
    const RELAX = 'RX';
    const SUDDENDEATH = 'SD';
    const WIND_UP = 'WU';
    const WIND_DOWN = 'WD';

    // osu-specific
    const OSU_AUTOPILOT = 'AP';
    const OSU_BLIND = 'BL';
    const OSU_SPUNOUT = 'SO';
    const OSU_TARGET = 'TP';
    const OSU_TRANSFORM = 'TR';
    const OSU_WIGGLE = 'WG';
    const OSU_GROW = 'GR';
    const OSU_DEFLATE = 'DF';
    const OSU_SPININ = 'SI';
    const OSU_TRACEABLE = 'TC';

    // mania-specific
    const MANIA_KEY1 = '1K';
    const MANIA_KEY2 = '2K';
    const MANIA_KEY3 = '3K';
    const MANIA_KEY4 = '4K';
    const MANIA_KEY5 = '5K';
    const MANIA_KEY6 = '6K';
    const MANIA_KEY7 = '7K';
    const MANIA_KEY8 = '8K';
    const MANIA_KEY9 = '9K';
    const MANIA_DUALSTAGES = 'DS';
    const MANIA_FADEIN = 'FI';
    const MANIA_MIRROR = 'MR';
    const MANIA_RANDOM = 'RD';

    // non-scorable
    const AUTOPLAY = 'AT';
    const CINEMA = 'CN';
    const NOMOD = 'NM';

    const SCORABLE_COMMON = [
        // common
        self::DAYCORE,
        self::DOUBLETIME,
        self::EASY,
        self::FLASHLIGHT,
        self::HIDDEN,
        self::HARDROCK,
        self::HALFTIME,
        self::NIGHTCORE,
        self::NOFAIL,
        self::PERFECT,
        self::RELAX,
        self::SUDDENDEATH,
        self::WIND_DOWN,
        self::WIND_UP,
    ];

    // Defines mutual-exclusivity for groups of mods, i.e. only one mod within each group can be active at a time
    const EXCLUSIVITY_COMMON = [
        [
            self::RELAX,
            self::SUDDENDEATH,
            self::NOFAIL,
            self::PERFECT,
            self::OSU_AUTOPILOT,
            self::OSU_SPUNOUT,
        ],
        [
            self::HARDROCK,
            self::EASY,
        ],
        [
            self::DOUBLETIME,
            self::HALFTIME,
            self::DAYCORE,
            self::NIGHTCORE,
            self::WIND_DOWN,
            self::WIND_UP,
        ],
        [
            self::MANIA_KEY1,
            self::MANIA_KEY2,
            self::MANIA_KEY3,
            self::MANIA_KEY4,
            self::MANIA_KEY5,
            self::MANIA_KEY6,
            self::MANIA_KEY7,
            self::MANIA_KEY8,
            self::MANIA_KEY9,
        ],
        [
            self::OSU_TRANSFORM,
            self::OSU_WIGGLE,
        ],
        [
            self::OSU_GROW,
            self::OSU_DEFLATE,
            self::OSU_SPININ,
            self::OSU_TRACEABLE,
        ],
        [
            self::HIDDEN,
            self::OSU_SPININ,
            self::OSU_TRACEABLE,
        ],
    ];

    // Mapping of valid mods per ruleset
    public static function validityByRuleset()
    {
        static $value;

        if (!$value) {
            $value = [
                Ruleset::OSU => array_merge(
                    self::SCORABLE_COMMON,
                    [
                        self::OSU_AUTOPILOT,
                        self::OSU_BLIND,
                        self::OSU_SPUNOUT,
                        self::OSU_TARGET,
                        self::OSU_TRANSFORM,
                        self::OSU_WIGGLE,
                        self::OSU_GROW,
                        self::OSU_DEFLATE,
                        self::OSU_SPININ,
                        self::OSU_TRACEABLE,
                    ]
                ),

                Ruleset::TAIKO => array_merge(
                    self::SCORABLE_COMMON,
                    [
                        // taiko-specific mods go here
                    ]
                ),

                Ruleset::CATCH => array_merge(
                    self::SCORABLE_COMMON,
                    [
                        // catch-specific mods go here
                    ]
                ),

                Ruleset::MANIA => array_merge(
                    self::SCORABLE_COMMON,
                    [
                        self::MANIA_KEY1,
                        self::MANIA_KEY2,
                        self::MANIA_KEY3,
                        self::MANIA_KEY4,
                        self::MANIA_KEY5,
                        self::MANIA_KEY6,
                        self::MANIA_KEY7,
                        self::MANIA_KEY8,
                        self::MANIA_KEY9,
                        self::MANIA_DUALSTAGES,
                        self::MANIA_FADEIN,
                        self::MANIA_MIRROR,
                        self::MANIA_RANDOM,
                    ]
                ),
            ];
        }

        return $value;
    }

    public static function exclusivityByRuleset()
    {
        static $value;

        if (!$value) {
            $value = [
                Ruleset::OSU => self::EXCLUSIVITY_COMMON,
                Ruleset::TAIKO => self::EXCLUSIVITY_COMMON,
                Ruleset::CATCH => self::EXCLUSIVITY_COMMON,
                Ruleset::MANIA => array_merge(
                    self::EXCLUSIVITY_COMMON,
                    [
                        [
                            self::FLASHLIGHT,
                            self::HIDDEN,
                            self::MANIA_FADEIN,
                        ],
                    ]
                ),
            ];
        }

        return $value;
    }

    // Mapping of valid mods per ruleset
    public static function validModsForRuleset($ruleset)
    {
        if (!in_array($ruleset, Ruleset::ALL, true)) {
            throw new InvariantException('invalid ruleset');
        }

        return static::validityByRuleset()[$ruleset];
    }

    public static function validForRuleset($acronym, $ruleset)
    {
        return in_array($acronym, static::validModsForRuleset($ruleset), true);
    }

    public static function validateSelection($mods, $ruleset, $skipExclusivityCheck = false)
    {
        $checkedMods = [];
        foreach ($mods as $mod) {
            if (!static::validForRuleset($mod, $ruleset)) {
                throw new InvariantException('invalid mod for ruleset: '.json_encode($mod));
            }

            if (isset($checkedMods[$mod])) {
                throw new InvariantException('duplicate mod for ruleset: '.json_encode($mod));
            }

            $checkedMods[$mod] = true;
        }

        if (!$skipExclusivityCheck) {
            foreach (static::exclusivityByRuleset()[$ruleset] as $group) {
                $intersection = array_intersect($mods, $group);
                if (count($intersection) > 1) {
                    throw new InvariantException('incompatible mods: '.implode(', ', $intersection));
                }
            }
        }

        return true;
    }

    public static function parseInputArray($mods, $ruleset)
    {
        $filteredMods = [];

        foreach ($mods as $mod) {
            if (isset($mod['acronym']) && present($mod['acronym'])) {
                $acronym = strtoupper($mod['acronym']);

                $filteredMods[$acronym] = [
                    'acronym' => $acronym,
                    'settings' => [],
                ];
                continue;
            }

            throw new InvariantException('invalid mod array');
        }

        $cleanMods = array_values($filteredMods);

        static::validateSelection(array_column($cleanMods, 'acronym'), $ruleset, true);

        return $cleanMods;
    }
}
