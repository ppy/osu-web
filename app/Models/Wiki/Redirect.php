<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Models\Wiki;

use App\Libraries\OsuWiki;
use Cache;
use Symfony\Component\Yaml\Yaml;

class Redirect
{
    public $path;

    private $cache = [];

    public function __construct($path)
    {
        $this->path = str_replace(' ', '_', strtolower($path));
    }

    public function target()
    {
        if (!array_key_exists('redirect', $this->cache)) {
            $this->cache['redirect'] = Cache::remember(
                'wiki:redirect',
                60,
                function () {
                    try {
                        return Yaml::parse(OsuWiki::fetchContent('wiki/redirect.yaml'), true);
                    } catch (GitHubNotFoundException $_e) {
                        return;
                    }
                }
            );
        }

        return $this->cache['redirect'][$this->path] ?? null;
    }
}
