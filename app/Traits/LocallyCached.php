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
 * Use forceVersionCheck to ensure version check on next memoize usage.
 */
trait LocallyCached
{
    use Memoizes {
        Memoizes::memoize as unversionedMemoize;
    }

    private $version;
    private $versionCheck = false;

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

        $this->forceVersionCheck();
    }

    public function forceVersionCheck(): void
    {
        $this->versionCheck = true;
    }

    protected function cachedFetch()
    {
        if ($this->version === null) {
            $this->validateVersion();
        }

        $cache = cache()->store(config('cache.local'));
        $key = 'local_cache:'.static::class;
        $value = $cache->get($key);

        if ($value === null || $value['version'] !== $this->version) {
            $value = [
                'data' => $this->fetch(),
                'version' => $this->version,
            ];
            $cache->forever($key, $value);
        }

        return $value['data'];
    }

    abstract protected function fetch();

    protected function memoize(string $key, callable $function)
    {
        $this->validateVersion();

        return $this->unversionedMemoize($key, $function);
    }

    private function validateVersion(): void
    {
        if ($this->version !== null && !$this->versionCheck) {
            return;
        }

        $this->versionCheck = false;
        $currentVersion = static::getCurrentVersion();

        if ($this->version !== null && $this->version !== $currentVersion) {
            $this->resetMemoized();
        }

        $this->version = $currentVersion;
    }
}
