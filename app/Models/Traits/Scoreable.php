<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

trait Scoreable
{
    protected $_enabledMods = null;

    private float $_accuracy;
    private int $_totalHits;

    abstract public function getMode(): string;

    public function getScoringType()
    {
        return 'score';
    }

    public function getEnabledModsAttribute($value)
    {
        return $this->_enabledMods ??= app('mods')->bitsetToIds($value);
    }

    public function totalHits(): int
    {
        return $this->_totalHits ??= match ($this->getMode()) {
            'osu' =>
                ($this->count50 + $this->count100 + $this->count300 + $this->countmiss) * 300,
            'fruits' =>
                $this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu,
            'mania' => (
                $this->getScoringType() === 'scorev2'
                    ? ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 305
                    : ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 300
            ),
            'taiko' =>
                ($this->count100 + $this->count300 + $this->countmiss) * 300,
        };
    }

    public function hits()
    {
        switch ($this->getMode()) {
            case 'osu':
                return $this->count50 * 50 + $this->count100 * 100 + $this->count300 * 300;
            case 'fruits':
                return $this->count50 + $this->count100 + $this->count300;
            case 'mania':
                if ($this->getScoringType() === 'scorev2') {
                    return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + $this->count300 * 300 + $this->countgeki * 305;
                } else {
                    return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + ($this->count300 + $this->countgeki) * 300;
                }
            case 'taiko':
                return $this->count100 * 150 + $this->count300 * 300;
        }
    }

    public function accuracy(): float
    {
        if (!isset($this->_accuracy)) {
            $totalHits = $this->totalHits();

            // in a rare case when the score row has zero hits
            // (found it occuring in multiplayer scores)
            $this->_accuracy = $totalHits === 0 ? 1 : $this->hits() / $totalHits;
        }

        return $this->_accuracy;
    }

    public function recalculateRank(): void
    {
        if (!$this->pass) {
            $this->rank = 'F';

            return;
        }

        $totalHits = $this->totalHits();
        $accuracy = $this->accuracy();
        $countMiss = $this->countmiss;

        switch ($this->getMode()) {
            case 'osu':
                $totalHitCount = $totalHits / 300;
                $ratio300 = (float) ($totalHits === 0 ? 1 : $this->count300 / $totalHitCount);
                $ratio50 = (float) ($totalHits === 0 ? 1 : $this->count50 / $totalHitCount);

                $this->rank = match (true) {
                    $ratio300 === 1.0 =>
                        $this->shouldHaveHiddenRank() ? 'XH' : 'X',
                    $ratio300 > 0.9 && $ratio50 <= 0.01 && $countMiss === 0 =>
                        $this->shouldHaveHiddenRank() ? 'SH' : 'S',
                    ($ratio300 > 0.8 && $countMiss === 0) || $ratio300 > 0.9 =>
                        'A',
                    ($ratio300 > 0.7 && $countMiss === 0) || $ratio300 > 0.8 =>
                        'B',
                    $ratio300 > 0.6 =>
                        'C',
                    default =>
                        'D',
                };

                break;

            case 'taiko':
                $totalHitCount = $totalHits / 300;
                $ratio300 = (float) ($totalHits === 0 ? 1 : $this->count300 / $totalHitCount);
                $ratio50 = (float) ($totalHits === 0 ? 1 : $this->count50 / $totalHitCount);

                $this->rank = match (true) {
                    $ratio300 === 1.0 =>
                        $this->shouldHaveHiddenRank() ? 'XH' : 'X',
                    $ratio300 > 0.9 && $ratio50 < 0.01 && $countMiss === 0 =>
                        $this->shouldHaveHiddenRank() ? 'SH' : 'S',
                    ($ratio300 > 0.8 && $countMiss === 0) || $ratio300 > 0.9 =>
                        'A',
                    ($ratio300 > 0.7 && $countMiss === 0) || $ratio300 > 0.8 =>
                        'B',
                    $ratio300 > 0.6 =>
                        'C',
                    default =>
                        'D',
                };

                break;

            case 'fruits':
                $this->rank = match (true) {
                    $accuracy === 1.0 =>
                        $this->shouldHaveHiddenRank() ? 'XH' : 'X',
                    $accuracy > 0.98 =>
                        $this->shouldHaveHiddenRank() ? 'SH' : 'S',
                    $accuracy > 0.94 =>
                        'A',
                    $accuracy > 0.9 =>
                        'B',
                    $accuracy > 0.85 =>
                        'C',
                    default =>
                        'D',
                };

                break;

            case 'mania':
                $this->rank = match (true) {
                    $accuracy === 1.0 =>
                        $this->shouldHaveHiddenRank() ? 'XH' : 'X',
                    $accuracy > 0.95 =>
                        $this->shouldHaveHiddenRank() ? 'SH' : 'S',
                    $accuracy > 0.9 =>
                        'A',
                    $accuracy > 0.8 =>
                        'B',
                    $accuracy > 0.7 =>
                        'C',
                    default =>
                        'D',
                };

                break;
        }
    }

    private function shouldHaveHiddenRank(): bool
    {
        foreach ($this->enabled_mods as $mod) {
            if ($mod === 'FI' || $mod === 'FL' || $mod === 'HD') {
                return true;
            }
        }

        return false;
    }
}
