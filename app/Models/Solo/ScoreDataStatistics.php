<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

class ScoreDataStatistics implements \JsonSerializable
{
    public array $attributes = [];

    public function __construct($inputData)
    {
        $n = 0;
        foreach (get_arr($inputData) ?? [] as $key => $value) {
            if ($n >= 32) {
                break;
            } else {
                $n++;
            }

            $intValue = get_int($value);

            if ($intValue !== null && $intValue !== 0) {
                $this->attributes[snake_case($key)] = $intValue;
            }
        }
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? 0;
    }

    public function isEmpty(): bool
    {
        return empty($this->attributes);
    }

    public function jsonSerialize(): array
    {
        // This shouldn't be needed but it's to guarantee the return has
        // at least one thing so php doesn't json encode it as array.
        // Using stdClass is an alternative but it's a lot of hacks
        // for what shouldn't be possible in the first place (short of
        // completely bogus score data).
        return $this->isEmpty()
            ? ['miss' => 0]
            : $this->attributes;
    }
}
