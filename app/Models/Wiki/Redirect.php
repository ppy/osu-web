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

class Redirect extends Page
{
    public $path;

    private $cache = [];

    public function __construct($path)
    {
        $this->path = $path/*str_replace(' ', '_', strtolower($this->path))*/;
    }

    public function target()
    {
        if (!array_key_exists('redirect', $this->cache) or true) {
            $this->cache['redirect'] = Cache::remember(
                $this->cacheKeyPage(),
                static::CACHE_DURATION,
                function () {
                    try {
                        $redirect = OsuWiki::fetchContent('wiki/redirect.txt');
                    } catch (GitHubNotFoundException $_e) {
                        return;
                    }

                    if (present($redirect)) {
                        return $redirect;
                    }
                }
            );
        }

        if ( array_key_exists($this->path, $this->cache['redirect']) ){
            return $this->cache['redirect'][$this->path];
        } else {
            return null;
        }
    }
}
