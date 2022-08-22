<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits;

trait WithWeightedPp
{
    public ?float $weight = null;

    public function weightedPp(): ?float
    {
        if ($this->weight !== null) {
            $pp = $this->pp;

            if ($pp !== null) {
                return $this->weight * $pp;
            }
        }

        return null;
    }
}
