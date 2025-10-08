<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Traits;

trait IncrementInstance
{
    /**
     * Just like increment but only works on saved instance instead of falling back to entire model
     */
    public function incrementInstance()
    {
        if (!$this->exists) {
            return false;
        }

        return $this->increment(...func_get_args());
    }
}
