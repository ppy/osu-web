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
