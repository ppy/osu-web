<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Country;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;

class Countries
{
    use Memoizes;

    private function allByCode(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => Country::get(['acronym', 'name'])->keyBy('acronym'));
    }

    public function byCode(string $code): ?Country
    {
        return $this->allByCode()->get($code);
    }
}
