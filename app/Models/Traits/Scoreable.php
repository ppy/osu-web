<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

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
