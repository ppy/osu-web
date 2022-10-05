<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class LayoutCache
{
    private array $cache = [];

    public function getBeatmapsetFilters()
    {
        $key = __FUNCTION__.':'.app()->getLocale();

        return $this->cache[$key] ??= view('beatmapsets._filters')->render();
    }
}
