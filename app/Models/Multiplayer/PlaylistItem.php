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

use Validator;
use App\Models\Beatmap;
use App\Libraries\ModsHelper;

class PlaylistItem extends \App\Models\Model
{
    protected $table = 'multiplayer_playlist_items';

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
        try {
            $this->attributes['allowed_mods'] = json_encode($this->validateMods($value));
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('invalid mod array (allowed_mods)');
        }
    }

    public function setRequiredModsAttribute(array $value)
    {
        try {
            $this->attributes['required_mods'] = json_encode($this->validateMods($value));
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('invalid mod array (required_mods)');
        }
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
    public function validateMods(array $mods)
    {
        $filteredMods = [];

        foreach ($mods as $mod) {
            if (isset($mod['acronym'])) {
                $acronym = strtoupper($mod['acronym']);
                if (in_array($acronym, ModsHelper::LAZER_SCORABLE_MODS)) {
                    $filteredMods[] = [
                        "acronym" => $acronym,
                        "settings" => [],
                    ];
                    continue;
                }
            }

            throw new \InvalidArgumentException('invalid mod array');
        }

        return $filteredMods;
    }
}
