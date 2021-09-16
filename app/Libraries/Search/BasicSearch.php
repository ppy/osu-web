<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\Search;

class BasicSearch extends Search
{
    /**
     * @param string $index Name of the index.
     * @param string $loggingTag Name to tag the operation with.
     */
    public function __construct(string $index, string $loggingTag = null)
    {
        parent::__construct($index, new EmptySearchParams());

        $this->loggingTag = $loggingTag;
    }

    public function data()
    {
        return $this->response();
    }

    public function getQuery()
    {
        return $this->query;
    }
}
