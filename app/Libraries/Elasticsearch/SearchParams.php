<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        return $this->isLoginRequired() && !auth()->check() && oauth_token() === null;
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
