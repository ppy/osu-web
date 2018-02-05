<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

class Query
{
    /**
     * @return $this
     */
    public function from(?int $from)
    {
        $this->from = $from;

        return $this;
    }

    public function limit(?int $limit)
    {
        return $this->size($limit);
    }

    /**
     * @return $this
     */
    public function size(?int $size)
    {
        $this->size = clamp($size ?? 50, 1, 50);

        return $this;
    }

    /**
     * @return $this
     */
    public function page(?int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * page is not returned if using offset query.
     *
     * @return array
     */
    public function getPageParams()
    {
        $params = ['size' => $this->size, 'limit' => $this->size];

        // from overrides page.
        if (isset($this->from)) {
            $params['from'] = $this->from;
        } else {
            $params['page'] = max(1, $this->page);
            $params['from'] = ($params['page'] - 1) * $this->size;
        }

        return $params;
    }

    /**
     * @return SearchResults
     */
    public function baseSearch(array $params) : SearchResults
    {
        return new SearchResults(Es::search($params));
    }

    /**
     * @return array
     */
    public function toQuery() : array
    {
        return [];
    }

    /**
     * @return array an empty Bool Query with all the keys initialized to empty.
     */
    public static function newBoolQuery() : array
    {
        return [
            'bool' => [
                'should' => [],
                'must' => [],
                'must_not' => [],
                'filter' => [],
            ],
        ];
    }
}
