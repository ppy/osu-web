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

namespace App\Libraries\Elasticsearch;

abstract class SearchParams
{
    /** @var int */
    public $from = 0;

    /** @var int */
    public $size = 50;

    /** @var array */
    public $sorts = [];

    /** @var array|null */
    public $searchAfter = null;

    public function __construct()
    {
    }

    /**
     * Gets the key useable as a cache key.
     *
     * @return string the cache key.
     */
    abstract public function getCacheKey(): string;

    /**
     * Checks if the current set of parameters is eligible for caching.
     *
     * @return bool true if the parameters are eligible for caching; false, otherwise.
     */
    abstract public function isCacheable(): bool;

    public function blockedUserIds()
    {
        $user = auth()->user();

        return $user !== null ? $user->blockedUserIds()->toArray() : [];
    }

    public function isQueryStringTooShort()
    {
        return mb_strlen($this->queryString) < config('osu.search.minimum_length');
    }

    public function isLoginRequired(): bool
    {
        return false;
    }

    public function shouldReturnEmptyResponse(): bool
    {
        return $this->isLoginRequired() && !auth()->check();
    }

    /**
     * Helper to convert a page request parameter to a from query parameter.
     * The desired page size should be set first, otherwise the default size will be used.
     *
     * @param $page
     * @return int
     */
    public function pageAsFrom($page): int
    {
        $page = max(1, $page ?? 1);

        return $this->size * ($page - 1);
    }
}
