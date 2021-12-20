<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;

class ForumSearchParams extends SearchParams
{
    use HasFilteredForums;

    const DEFAULT_SORT_ORDER = 'desc';
    const VALID_SORT_FIELDS = ['relevance', 'created'];

    // all public because lazy.

    /** @var int|null */
    public $forumId = null;

    /** @var bool */
    public $includeSubforums = false;

    /** @var string|null */
    public $queryString = null;

    /** {@inheritdoc} */
    public $size = 20;

    /** @var int|null */
    public $topicId = null;

    /** @var int|null */
    public $username = null;

    /** @var string */
    public $sortField = 'relevance';

    /** @var string */
    public $sortOrder = self::DEFAULT_SORT_ORDER;

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return false;
    }
}
