<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class LocalCacheManager
{
    private int $resetTicker = 0;
    private int $resetTickerLimit;
    private array $singletons = [];

    public function incrementResetTicker(): void
    {
        $this->resetTicker++;
        $this->resetTickerLimit ??= config('osu.octane.local_cache_reset_requests');

        if ($this->resetTicker > $this->resetTickerLimit) {
            $this->resetTicker = 0;
            $this->resetCache();
        }
    }

    public function registerSingleton($singleton): void
    {
        $this->singletons[] = $singleton;
    }

    private function resetCache(): void
    {
        foreach ($this->singletons as $singleton) {
            $singleton->resetMemoized();
        }
    }
}
