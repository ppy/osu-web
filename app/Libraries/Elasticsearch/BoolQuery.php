<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Elasticsearch;

class BoolQuery implements Queryable
{
    protected $filters = [];
    protected $musts = [];
    protected $mustNots = [];
    protected $shoulds = [];
    protected $minimum = null;

    public function filter(array|Queryable $clause): static
    {
        $this->filters[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->filters === []
            && $this->musts === []
            && $this->mustNots === []
            && $this->shoulds === [];
    }

    public function must(array|Queryable $clause): static
    {
        $this->musts[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    public function mustNot(array|Queryable $clause): static
    {
        $this->mustNots[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    public function should(array|Queryable $clause): static
    {
        $this->shoulds[] = QueryHelper::clauseToArray($clause);

        return $this;
    }

    /**
     * minimum_should_match.
     */
    public function shouldMatch(?int $count): static
    {
        $this->minimum = $count;

        return $this;
    }

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
