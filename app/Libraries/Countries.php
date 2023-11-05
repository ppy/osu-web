<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class Countries
{
    private array $countries;

    private function allByCode(): Collection
    {
        return $this->fetch()->keyBy('acronym');
    }

    public function byCode(string $code): ?Country
    {
        if (!isset($this->countries)) {
            $this->countries = $this->allByCode()->all();
        }

        return $this->countries[$code] ?? null;
    }

    protected function fetch(): Collection
    {
        return Country::get(['acronym', 'name']);
    }
}
