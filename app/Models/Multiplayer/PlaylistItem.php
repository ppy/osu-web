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

namespace App\Models\Multiplayer;

use App\Libraries\Multiplayer\Mod;
use App\Libraries\Multiplayer\Ruleset;
use App\Models\Beatmap;

class PlaylistItem extends \App\Models\Model
{
    protected $table = 'multiplayer_playlist_items';

    const MOD_TYPE_REQUIRED = 'required_mods';
    const MOD_TYPE_ALLOWED = 'allowed_mods';

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function setAllowedModsAttribute(array $value)
    {
        $this->attributes['allowed_mods'] = json_encode($this->validateModArray($value, self::MOD_TYPE_ALLOWED));
    }

    public function setRequiredModsAttribute(array $value)
    {
        $this->attributes['required_mods'] = json_encode($this->validateModArray($value, self::MOD_TYPE_REQUIRED));
    }

    public function getAllowedModsAttribute(string $value)
    {
        return json_decode($value);
    }

    public function getRequiredModsAttribute(string $value)
    {
        return json_decode($value);
    }

    // Example of expected structure for mods:
    //  [
    //     {"acronym": "HD"},
    //     {"acronym": "DT", "settings": {...}},
    //  ]
    //
    public function validateModArray(array $mods, $mode)
    {
        $filteredMods = [];

        foreach ($mods as $mod) {
            if (isset($mod['acronym'])) {
                $acronym = strtoupper($mod['acronym']);
                if (!Mod::validForRuleset($acronym, $this->ruleset_id)) {
                    throw new \InvalidArgumentException("invalid mod in '{$mode}': {$acronym}");
                }

                if (isset($filteredMods[$acronym])) {
                    throw new \InvalidArgumentException("duplicate mod in '{$mode}': {$acronym}");
                }

                $filteredMods[$acronym] = [
                    "acronym" => $acronym,
                    "settings" => [],
                ];
                continue;
            }

            throw new \InvalidArgumentException("invalid mod array ({$mode})");
        }

        return array_values($filteredMods);
    }

    private function validateRuleset()
    {
        // osu beatmaps can be played in any mode, but non-osu maps can only be played in their specific modes
        if ($this->beatmap->playmode !== Ruleset::OSU && $this->beatmap->playmode !== $this->ruleset_id) {
            throw new \InvalidArgumentException("invalid ruleset_id for beatmap {$this->beatmap->beatmap_id}");
        }
    }

    private function validateModExclusivityGroups()
    {
        foreach (Mod::exclusivityByRuleset()[$this->ruleset_id] as $group) {
            $intersection = array_intersect(array_column($this->required_mods, 'acronym'), $group);
            if (count($intersection) > 1) {
                throw new \InvalidArgumentException('incompatible mods: '.join(', ', $intersection));
            }
        }
    }

    private function validateModOverlaps()
    {
        $dupeMods = array_intersect(
            array_column($this->allowed_mods, 'acronym'),
            array_column($this->required_mods, 'acronym')
        );

        if (count($dupeMods) > 0) {
            throw new \InvalidArgumentException('mod cannot be listed as both allowed and required: '.join(', ', $dupeMods));
        }
    }

    public function save(array $options = [])
    {
        $this->validateRuleset();
        $this->validateModExclusivityGroups();
        $this->validateModOverlaps();

        return parent::save($options);
    }
}
