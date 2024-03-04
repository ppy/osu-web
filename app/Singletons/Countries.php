<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Country;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;

class Countries
{
    use Memoizes;

    public function byCode(string $code): ?Country
    {
        return $this->allByCode()->get($code);
    }

    private function allByCode(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => Country::get(['acronym', 'name'])->keyBy('acronym'));
    }
}
