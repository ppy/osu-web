<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

trait WithWeightedPp
{
    public ?float $weight = null;

    public function weightedPp(): ?float
    {
        if ($this->weight === null) {
            return null;
        }

        $pp = $this->pp;

        return $pp === null ? null : $this->weight * $pp;
    }
}
