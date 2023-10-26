<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Country;
use App\Traits\Memoizes;

class Countries
{
    use Memoizes;

    public function byCode(string $code): ?Country
    {
        return $this->memoize(__FUNCTION__.':'.$code, fn () => Country::find($code));
    }
}
