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

namespace App\Traits;

use App\Libraries\ModsHelper;

trait Scoreable
{
    protected $_enabledMods = null;
    private $gameModeString = null;

    public function gameModeString()
    {
        if ($this->gameModeString === null) {
            $this->gameModeString = snake_case(get_class_basename(static::class));
        }

        return $this->gameModeString;
    }

    public function getScoringType()
    {
        return 'score';
    }

    public function getEnabledModsAttribute($value)
    {
        if ($this->_enabledMods === null) {
            $this->_enabledMods = ModsHelper::toArray($value);
        }

        return $this->_enabledMods;
    }

    public function totalHits()
    {
        if ($this->gameModeString() === 'osu') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss) * 300;
        } elseif ($this->gameModeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300 +
                $this->countmiss + $this->countkatu;
        } elseif ($this->gameModeString() === 'mania') {
            if ($this->getScoringType() === 'scorev2') {
                return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 305;
            } else {
                return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 300;
            }
        } elseif ($this->gameModeString() === 'taiko') {
            return ($this->count100 + $this->count300 + $this->countmiss) * 300;
        }
    }

    public function hits()
    {
        if ($this->gameModeString() === 'osu') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->count300 * 300;
        } elseif ($this->gameModeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300;
        } elseif ($this->gameModeString() === 'mania') {
            if ($this->getScoringType() === 'scorev2') {
                return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + $this->count300 * 300 + $this->countgeki * 305;
            } else {
                return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + ($this->count300 + $this->countgeki) * 300;
            }
        } elseif ($this->gameModeString() === 'taiko') {
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
