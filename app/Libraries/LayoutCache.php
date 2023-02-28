<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Traits\Memoizes;

class LayoutCache
{
    use Memoizes;

    public function getBeatmapsetFilters(): string
    {
        return $this->memoize(__FUNCTION__.':'.app()->getLocale(), fn () =>
            view('beatmapsets._filters')->render());
    }

    public function getLocalesDesktop(): string
    {
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->memoize($key, fn () =>
            view('layout.nav2._locales', [
                'currentLocaleMeta' => locale_meta($currentLocale),
            ])->render());
    }

    public function getLocalesLanding(): string
    {
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->memoize($key, fn () =>
            view('home._landing_locales', [
                'currentLocaleMeta' => locale_meta($currentLocale),
            ])->render());
    }

    public function getLocalesMobile(): string
    {
        $currentLocale = app()->getLocale();
        $key = __FUNCTION__.':'.$currentLocale;

        return $this->memoize($key, fn () =>
            view('layout.header_mobile._locales', [
                'currentLocaleMeta' => locale_meta($currentLocale),
            ])->render());
    }
}
