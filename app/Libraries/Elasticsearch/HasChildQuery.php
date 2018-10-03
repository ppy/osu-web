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

use App\Libraries\Search\EmptySearchParams;

class HasChildQuery extends HasSearch implements Queryable
{
    protected $name;
    protected $scoreMode;

    public function __construct(string $type, string $name)
    {
        parent::__construct(new EmptySearchParams);

        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return $this
     */
    public function scoreMode(string $mode)
    {
        $this->scoreMode = $mode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        // some of the parameters that normally go in body get moved into
        // inner_hits in join queries.
        $inner = [
            'name' => $this->name,
            'from' => $this->params->from,
            'size' => $this->getQuerySize(),
            'sort' => array_map(function ($sort) {
                return $sort->toArray();
            }, $this->params->sorts),
        ];

        if (isset($this->highlight)) {
            $inner['highlight'] = $this->highlight->toArray();
        }

        if (isset($this->source)) {
            $inner['_source'] = $this->source;
        }

        $body = [
            'type' => $this->type,
            'inner_hits' => $inner,
            'query' => QueryHelper::clauseToArray($this->query),
        ];

        if (isset($this->scoreMode)) {
            $body['score_mode'] = $this->scoreMode;
        }

        return ['has_child' => $body];
    }
}
