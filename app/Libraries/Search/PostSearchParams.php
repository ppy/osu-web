<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;

class PostSearchParams extends SearchParams
{
    use HasFilteredForums;

    // all public because lazy.

    /** @var int|null */
    public $forumId = null;

    /** @var int|null */
    public $topicId = null;

    /** @var bool */
    public $includeSubforums = false;

    /** @var string|null */
    public $queryString = null;

    /** @var int */
    public $userId = -1;

    /**
     * {@inheritdoc}
     */
    public function getCacheKey(): string
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'post-search:'.json_encode($vars);
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return false;
    }
}
