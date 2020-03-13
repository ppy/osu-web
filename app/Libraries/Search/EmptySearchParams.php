<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;

class EmptySearchParams extends SearchParams
{
    /**
     * {@inheritdoc}
     */
    public function getCacheKey(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return false;
    }
}
