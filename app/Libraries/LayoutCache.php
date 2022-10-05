<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class LayoutCache
{
    private array $cache = [];

    public function getBeatmapsetFilters(): string
    {
        $key = __FUNCTION__.':'.app()->getLocale();

        return $this->cache[$key] ??= view('beatmapsets._filters')->render();
    }

    public function getLocalesDesktop(): string
    {
        $currentLocaleMeta = current_locale_meta();
        $key = __FUNCTION__.':'.$currentLocaleMeta->name();

        return $this->cache[$key] ??= view('layout.nav2._locales', compact('currentLocaleMeta'))->render();
    }

    public function getLocalesLanding(): string
    {
        $currentLocaleMeta = current_locale_meta();
        $key = __FUNCTION__.':'.$currentLocaleMeta->name();

        return $this->cache[$key] ??= view('home._landing_locales', compact('currentLocaleMeta'))->render();
    }

    public function getLocalesMobile(): string
    {
        $currentLocaleMeta = current_locale_meta();
        $key = __FUNCTION__.':'.$currentLocaleMeta->name();

        return $this->cache[$key] ??= view('layout.header_mobile._locales', compact('currentLocaleMeta'))->render();
    }
}
