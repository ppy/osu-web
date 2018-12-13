<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Libraries\Multiplayer;

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

    // osu-specific
    const OSU_AUTOPILOT = 'AP';
    const OSU_SPUNOUT = 'SO';
    const OSU_TARGET = 'TP';
    const OSU_TRANSFORM = 'TR';
    const OSU_WIGGLE = 'WG';

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
        ]
    ];

    // Mapping of valid mods per ruleset
    public static function validityByRuleset()
    {
        return [
            Ruleset::OSU => array_merge(
                self::SCORABLE_COMMON,
                [
                    self::OSU_AUTOPILOT,
                    self::OSU_SPUNOUT,
                    self::OSU_TARGET,
                    self::OSU_TRANSFORM,
                    self::OSU_WIGGLE,
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

    public static function exclusivityByRuleset()
    {
        return [
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

    // Mapping of valid mods per ruleset
    public static function validModsForRuleset($ruleset)
    {
        if (!in_array($ruleset, Ruleset::ALL)) {
            throw new \InvalidArgumentException('invalid ruleset');
        }

        return self::validityByRuleset()[$ruleset];
    }

    public static function validForRuleset($acronym, $ruleset)
    {
        return in_array($acronym, self::validModsForRuleset($ruleset));
    }

    public static function validateSelection($mods, $ruleset, $skipExclusivityCheck = false)
    {
        $checkedMods = [];
        foreach ($mods as $mod) {
            if (!self::validForRuleset($mod, $ruleset)) {
                throw new \InvalidArgumentException("invalid mod for ruleset: {$mod}");
            }

            if (isset($checkedMods[$mod])) {
                throw new \InvalidArgumentException("duplicate mod for ruleset: {$mod}");
            }

            $checkedMods[$mod] = true;
        }

        if (!$skipExclusivityCheck) {
            foreach (self::exclusivityByRuleset()[$ruleset] as $group) {
                $intersection = array_intersect($mods, $group);
                if (count($intersection) > 1) {
                    throw new \InvalidArgumentException('incompatible mods: '.join(', ', $intersection));
                }
            }
        }

        return true;
    }
}
