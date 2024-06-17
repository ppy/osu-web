<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Models\Forum\LegacyIcon;
use App\Traits\Memoizes;
use Illuminate\Database\Eloquent\Collection;

class ForumLegacyIcons
{
    use Memoizes;

    /**
     * Get a legacy forum icon by its ID.
     */
    public function byId(int $id): ?LegacyIcon
    {
        return $this->allById()->get($id);
    }

    /**
     * @return Collection<int, LegacyIcon>
     */
    private function allById(): Collection
    {
        return $this->memoize(__FUNCTION__, fn () => LegacyIcon::all()->keyBy('icons_id'));
    }
}
