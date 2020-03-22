<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Wiki\WikiObject;
use Exception;
use Symfony\Component\Yaml\Yaml;

class WikiRedirect implements WikiObject
{
    const CACHE_DURATION = 1 * 60 * 60;
    const CACHE_KEY = 'wiki:redirect:v2';

    private $cache;

    public function __construct()
    {
        $this->fetchCache();
    }

    public function fetchCache()
    {
        $this->cache = cache()->get(static::CACHE_KEY);
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function needsSync()
    {
        return $this->cache === null
            || ($this->cache['cached_at'] + static::CACHE_DURATION) < time();
    }

    public function normalizePath($path)
    {
        return str_replace(' ', '_', strtolower($path));
    }

    public function resolve($path)
    {
        return $this->cache['redirect'][$this->normalizePath($path)] ?? null;
    }

    public function sync($force = false)
    {
        if (!$force && !$this->needsSync()) {
            return $this;
        }

        $lock = cache()->lock(static::CACHE_KEY.':lock', 300);

        // only one process may sync at once
        if (!$lock->get()) {
            return $this;
        }

        try {
            $redirect = Yaml::parse(strip_utf8_bom(OsuWiki::fetchContent('wiki/redirect.yaml')));
        } catch (Exception $e) {
            log_error($e);

            return $this;
        } finally {
            $lock->release();
        }

        $this->cache = [
            'redirect' => $redirect ?? [],
            'cached_at' => time(),
        ];
        cache()->put(static::CACHE_KEY, $this->cache);

        return $this;
    }
}
