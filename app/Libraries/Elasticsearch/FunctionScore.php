<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

class FunctionScore implements Queryable
{
    private string $boostMode = 'multiply';
    private array $functions = [];

    public function __construct(private Queryable $query)
    {
    }

    public function applyFunction(array $function): static
    {
        $this->functions[] = $function;

        return $this;
    }

    public function boostMode(string $boostMode): static
    {
        $this->boostMode = $boostMode;

        return $this;
    }

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
