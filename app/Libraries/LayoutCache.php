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
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->cache[$key] ??= view('layout.nav2._locales', [
            'currentLocaleMeta' => locale_meta($currentLocale),
        ])->render();
    }

    public function getLocalesLanding(): string
    {
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->cache[$key] ??= view('home._landing_locales', [
            'currentLocaleMeta' => locale_meta($currentLocale),
        ])->render();
    }

    public function getLocalesMobile(): string
    {
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->cache[$key] ??= view('layout.header_mobile._locales', [
            'currentLocaleMeta' => locale_meta($currentLocale),
        ])->render();
    }
}
