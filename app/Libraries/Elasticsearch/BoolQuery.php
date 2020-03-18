<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

class BoolQuery implements Queryable
{
    protected $filters = [];
    protected $musts = [];
    protected $mustNots = [];
    protected $shoulds = [];
    protected $minimum = null;

    /**
     * @param array|Queryable $clause
     *
     * @return $this
     */
    public function filter($clause)
    {
        $this->filters[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    /**
     * @param array|Queryable $clause
     *
     * @return $this
     */
    public function must($clause)
    {
        $this->musts[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    /**
     * @param array|Queryable $clause
     *
     * @return $this
     */
    public function mustNot($clause)
    {
        $this->mustNots[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    /**
     * @param array|Queryable $clause
     *
     * @return $this
     */
    public function should($clause)
    {
        $this->shoulds[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    /**
     * minimum_should_match.
     *
     * @return $this
     */
    public function shouldMatch(?int $count)
    {
        $this->minimum = $count;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $bool = [
            'bool' => [
                'should' => $this->shoulds,
                'must' => $this->musts,
                'must_not' => $this->mustNots,
                'filter' => $this->filters,
            ],
        ];

        if ($this->minimum !== null) {
            $bool['bool']['minimum_should_match'] = $this->minimum;
        }

        return $bool;
    }
}
