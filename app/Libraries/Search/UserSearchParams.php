<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;

class UserSearchParams extends SearchParams
{
    const VALID_SORT_FIELDS = ['relevance', 'username'];
    const DEFAULT_SORT_FIELD = 'relevance';

    // all public because lazy.

    public $queryString = null;
    public $recentOnly = false;

    public $sortField = 'relevance';
    public $sortOrder = 'desc';

    /** {@inheritdoc} */
    public $size = 20;

    public static function defaultSortOrder(string $field)
    {
        switch ($field) {
            case 'username':
                return 'asc';
            default:
                return 'desc';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey(): string
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'user-search:'.json_encode($vars);
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return false;
    }
}
