<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries\Search;

use Cache;

abstract class SearchParams
{
    /**
     * Magic execute and cache if isCacheable() function.
     * This does not seem like the best place for it but it will do for now.
     */
    public function fetchCacheable(string $cacheKey, float $duration, callable $callable)
    {
        if ($this->isCacheable()) {
            return Cache::remember($cacheKey, $duration, function () use ($callable) {
                return $callable();
            });
        }

        return $callable();
    }

    abstract public function getCacheKey();
    abstract public function isCacheable();
}
