<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

/**
 * Nested caching to reduce large request defined in "fetch" function
 * of whatever using this trait.
 *
 * Memoizes trait is included and reset accordingly.
 *
 * Use cachedFetch instead of fetch to fetch the data.
 * Use resetCache to force reset on all instances.
 * Use validateVersion to ensure current instance data is recent (only if already loaded).
 */
trait LocallyCached
{
    use Memoizes;

    private $version;

    private static function getVersionCacheKey(): string
    {
        return 'local_cache:'.static::class.':version';
    }

    private static function getCurrentVersion(): int
    {
        $cacheKey = static::getVersionCacheKey();
        $version = cache()->get($cacheKey);

        if ($version === null) {
            $version = hrtime(true);
            cache()->forever($cacheKey, $version);
        }

        return $version;
    }

    public function resetCache(): void
    {
        cache()->put(static::getVersionCacheKey(), hrtime(true));

        $this->resetMemoized();
    }

    public function validateVersion(): void
    {
        if ($this->version === null) {
            return;
        }

        $currentVersion = static::getCurrentVersion();

        if ($this->version !== $currentVersion) {
            $this->resetMemoized();
        }
    }

    protected function cachedFetch()
    {
        $version = static::getCurrentVersion();
        $cache = cache()->store(config('cache.local'));
        $key = 'local_cache:'.static::class;
        $value = $cache->get($key);

        if ($value === null || $value['version'] !== $version) {
            $value = [
                'data' => $this->fetch(),
                'version' => $version,
            ];
            $cache->forever($key, $value);
        }

        $this->version = $version;

        return $value['data'];
    }
}
