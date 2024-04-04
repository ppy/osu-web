<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

class LocalCacheManager
{
    private int $resetTicker = 0;
    private array $singletons = [];

    public function incrementResetTicker(): void
    {
        $this->resetTicker++;

        if ($this->resetTicker > $GLOBALS['cfg']['osu']['octane']['local_cache_reset_requests']) {
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
