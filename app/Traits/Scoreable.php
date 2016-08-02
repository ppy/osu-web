<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
namespace App\Traits;

use App\Libraries\ModsFromDB;

trait Scoreable
{
    protected $_enabledMods = null;

    public function gamemodeString()
    {
        return snake_case(get_class_basename(static::class));
    }

    public function getEnabledModsAttribute($value)
    {
        if ($this->_enabledMods === null) {
            $this->_enabledMods = ModsFromDB::getEnabledMods($value);
        }

        return $this->_enabledMods;
    }

    public function totalHits()
    {
        if (static::gamemodeString() === 'osu') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss) * 300;
        } elseif (static::gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300 +
                $this->countmiss + $this->countkatu;
        } elseif (static::gamemodeString() === 'mania') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 300;
        } elseif (static::gamemodeString() === 'taiko') {
            return ($this->count100 + $this->count300 + $this->countmiss) * 300;
        }
    }

    public function hits()
    {
        if (static::gamemodeString() === 'osu') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->count300 * 300;
        } elseif (static::gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300;
        } elseif (static::gamemodeString() === 'mania') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + ($this->count300 + $this->countgeki) * 300;
        } elseif (static::gamemodeString() === 'taiko') {
            return $this->count100 * 150 + $this->count300 * 300;
        }
    }

    public function accuracy()
    {
        $hits = $this->hits();
        $totalHits = $this->totalHits();

        // in a rare case when the score row has zero hits
        // (found it occuring in multiplayer scores)
        if ($totalHits === 0) {
            return 0;
        } else {
            return $hits / $totalHits;
        }
    }
}
