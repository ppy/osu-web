<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class LocalCacheManager
{
    private int $resetTicker = 0;
    private int $resetTickerLimit;

    public function incrementResetTicker(): void
    {
        $this->resetTicker++;
        $this->resetTickerLimit ??= config('osu.octane.local_cache_reset_requests');

        if ($this->resetTicker > $this->resetTickerLimit) {
            $this->resetTicker = 0;
            $this->resetCache();
        }
    }

    private function resetCache(): void
    {
        foreach (['chat-filters', 'groups', 'layout-cache'] as $memoizedSingleton) {
            app($memoizedSingleton)->resetMemoized();
        }
    }
}
