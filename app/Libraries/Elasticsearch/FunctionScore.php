<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

class FunctionScore implements Queryable
{
    private $boostMode = 'multiply';
    private $functions = [];
    private $query;

    /**
     * @param array|Queryable $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function applyFunction(array $function): self
    {
        $this->functions[] = $function;

        return $this;
    }

    public function boostMode(string $boostMode): self
    {
        $this->boostMode = $boostMode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'function_score' => [
                'boost_mode' => $this->boostMode,
                'functions' => $this->functions,
                'query' => QueryHelper::clauseToArray($this->query),
            ],
        ];
    }
}
