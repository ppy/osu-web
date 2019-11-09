<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries;

use App\Models\Wiki\WikiObject;
use Cache;
use Symfony\Component\Yaml\Yaml;

class WikiRedirect implements WikiObject
{
    const CACHE_KEY = 'wiki:redirect';

    private $cache = [];

    public function normalizePath($path)
    {
        return str_replace(' ', '_', strtolower($path));
    }

    public function resolve($path)
    {
        if (!array_key_exists('redirect', $this->cache)) {
            $this->cache['redirect'] = $this->get();
        }

        return $this->cache['redirect'][$this->normalizePath($path)] ?? null;
    }

    public function forget($synchronous = false)
    {
        Cache::forget(static::CACHE_KEY);
    }

    public function get($synchronous = false)
    {
        return Cache::remember(
            static::CACHE_KEY,
            3600,
            function () {
                try {
                    return Yaml::parse(strip_utf8_bom(OsuWiki::fetchContent('wiki/redirect.yaml')));
                } catch (GitHubNotFoundException $_e) {
                    return;
                }
            }
        );
    }
}
