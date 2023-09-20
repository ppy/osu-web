<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Illuminate\Cache\RateLimiter as CacheRateLimiter;

class RateLimiter extends CacheRateLimiter
{
    // overriden version of hit() to support a cost.
    public function hit($key, $decaySeconds = 60, int $cost = 1)
    {
        $key = $this->cleanRateLimiterKey($key);

        $this->cache->add(
            $key.':timer',
            $this->availableAt($decaySeconds),
            $decaySeconds
        );

        // TODO: this can be better
        $added = $this->cache->add($key, 0, $decaySeconds);

        $hits = (int) $this->cache->increment($key, $cost);

        // supposedly to make sure any existing key has an expiry.
        if (!$added && $hits === $cost) {
            $this->cache->put($key, $cost, $decaySeconds);
        }

        return $hits;
    }
}
