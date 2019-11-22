<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
