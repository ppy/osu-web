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

use Cache;
use Symfony\Component\Yaml\Yaml;

class WikiRedirect
{
    private $cache = [];

    public function normalizePath($path)
    {
        return str_replace(' ', '_', strtolower($path));
    }

    public function resolve($path)
    {
        if (!array_key_exists('redirect', $this->cache)) {
            $this->cache['redirect'] = Cache::remember(
                'wiki:redirect',
                60,
                function () {
                    try {
                        return Yaml::parse(strip_utf8_bom(OsuWiki::fetchContent('wiki/redirect.yaml')));
                    } catch (GitHubNotFoundException $_e) {
                        return;
                    }
                }
            );
        }

        return $this->cache['redirect'][$this->normalizePath($path)] ?? null;
    }
}
