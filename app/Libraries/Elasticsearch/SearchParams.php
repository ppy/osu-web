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

namespace App\Libraries\Elasticsearch;

use Cache;

abstract class SearchParams
{
    /** @var int|null */
    public $page = null;

    /** @var int|null */
    public $size = null;

    /** @var Sort */
    public $sort = null;

    /**
     * Magic execute and cache if isCacheable() function.
     * This does not seem like the best place for it but it will do for now.
     */
    public function fetchCacheable(?string $prefix = null, float $duration, callable $callable)
    {
        if ($this->isCacheable()) {
            return Cache::remember("{$prefix}{$this->getCacheKey()}", $duration, function () use ($callable) {
                return $callable();
            });
        }

        return $callable();
    }

    /**
     * Gets the key useable as a cache key.
     *
     * @return string the cache key.
     */
    abstract public function getCacheKey() : string;

    /**
     * Checks if the current set of parameters is eligible for caching.
     *
     * @return bool true if the parameters are eligible for caching; false, otherwise.
     */
    abstract public function isCacheable() : bool;
}
