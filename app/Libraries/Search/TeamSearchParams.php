<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Libraries\Elasticsearch\Sort;

class TeamSearchParams extends SearchParams
{
    public $size = 20;

    public string $sortField;
    public string $sortOrder;

    public static function defaultSortOrder(string $field): string
    {
        return $field === 'relevance' || $field === 'created' ? 'desc' : 'asc';
    }

    public function isCacheable(): bool
    {
        return false;
    }

    public function parseSort(?string $sort): void
    {
        $options = explode('_', $sort ?? '');
        $field = $options[0];
        $order = $options[1] ?? null;

        $this->sortField = in_array($field, $this->validSortFields(), true)
            ? $field
            : (present($this->queryString) ? 'relevance' : 'created');

        $this->sortOrder = in_array($order, ['asc', 'desc'], true)
            ? $order
            : static::defaultSortOrder($this->sortField);

        $this->sorts = match ($this->sortField) {
            'created' => [new Sort('id', $this->sortOrder)],
            'name' => [new Sort('name.raw', $this->sortOrder)],
            'relevance' => [
                new Sort('_score', $this->sortOrder),
                new Sort('name.raw', $this->sortOrder === 'desc' ? 'asc' : 'desc'),
            ],
            'short-name' => [new Sort('short_name.raw', $this->sortOrder)],
        };
    }

    public function validSortFields(): array
    {
        return present($this->queryString)
            ? ['relevance', 'created', 'name', 'short-name']
            : ['created', 'name', 'short-name'];
    }
}
