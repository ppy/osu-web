<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use JsonSerializable;

class ScoreDataStatistics implements JsonSerializable
{
    public int $good;
    public int $great;
    public int $ignoreHit;
    public int $ignoreMiss;
    public int $largeBonus;
    public int $largeTickHit;
    public int $largeTickMiss;
    public int $legacyComboIncrease;
    public int $meh;
    public int $miss;
    public int $ok;
    public int $perfect;
    public int $smallBonus;
    public int $smallTickHit;
    public int $smallTickMiss;

    public function __construct($inputData)
    {
        $inputData = get_arr($inputData) ?? [];

        foreach (static::fields() as $field => $map) {
            $this->$field = get_int($inputData[$map['json']] ?? $inputData[$map['json_old']] ?? 0) ?? 0;
        }
    }

    private static function fields(): array
    {
        static $map;

        if (!isset($map)) {
            $map = [];
            $fields = [
                'good',
                'great',
                'ignoreHit',
                'ignoreMiss',
                'largeBonus',
                'largeTickHit',
                'largeTickMiss',
                'legacyComboIncrease',
                'meh',
                'miss',
                'ok',
                'perfect',
                'smallBonus',
                'smallTickHit',
                'smallTickMiss',
            ];

            foreach ($fields as $field) {
                $map[$field] = [
                    'json' => snake_case($field),
                    'json_old' => studly_case($field),
                ];
            }
        }

        return $map;
    }

    public function isEmpty(): bool
    {
        foreach (static::fields() as $field => $_map) {
            if ($this->$field !== 0) {
                return false;
            }
        }

        return true;
    }

    public function jsonSerialize(): array
    {
        $ret = [];

        $fields = static::fields();
        foreach ($fields as $field => $map) {
            $value = $this->$field;

            if ($value !== 0) {
                $ret[$map['json']] = $value;
            }
        }

        // This shouldn't be needed but it's to guarantee the return has
        // at least one thing so php doesn't json encode it as array.
        // Using stdClass is an alternative but it's a lot of hacks
        // for what shouldn't be possible in the first place (short of
        // completely bogus score data).
        if (empty($ret)) {
            $ret[$fields['miss']['json']] = $this->miss;
        }

        return $ret;
    }
}
