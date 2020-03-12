<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use Illuminate\Pagination\LengthAwarePaginator;

class SearchPaginator extends LengthAwarePaginator
{
    protected $search;

    public function __construct(Search $search, $perPage, $currentPage = null, array $options = [])
    {
        if (!isset($options['path'])) {
            $options['path'] = LengthAwarePaginator::resolveCurrentPath();
        }

        parent::__construct(
            $search->data(),
            $search->total(),
            $perPage,
            $currentPage,
            $options
        );

        $this->search = $search;
    }

    public function getSearch()
    {
        return $this->search;
    }
}
