<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * For columns which use unix timestamp as its value and repurpose 0 as null.
 */
class TimestampOrZero implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value === null || $value === 0 ? null : Carbon::createFromTimestamp($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value === null ? 0 : $value->getTimestamp();
    }
}
