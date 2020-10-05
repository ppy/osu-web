<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use App\Libraries\Search\EmptySearchParams;

class HasChildQuery extends HasSearch implements Queryable
{
    protected $name;
    protected $scoreMode;

    public function __construct(string $type, string $name)
    {
        parent::__construct(new EmptySearchParams());

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
    public function toArray(): array
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
