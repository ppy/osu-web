<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PresentString implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return presence($value);
    }

    // presence check is only done when retrieving the value
    public function set($model, string $key, $value, array $attributes)
    {
        return get_string($value);
    }
}
