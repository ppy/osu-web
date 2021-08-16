<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\ChatFilter;
use App\Traits\LocallyCached;
use Illuminate\Database\Eloquent\Collection;

class ChatFilters
{
    use LocallyCached;

    public function all()
    {
        return $this->cachedMemoize(__FUNCTION__, fn () => $this->fetch());
    }

    protected function fetch(): Collection
    {
        return ChatFilter::all();
    }
}
