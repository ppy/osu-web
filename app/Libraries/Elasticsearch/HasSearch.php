<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

abstract class HasSearch
{
    protected ?Highlight $highlight = null;
    protected SearchParams $params;
    protected array|Queryable $query;
    protected array|false|null $source = null;
    protected ?string $type = null;

    public function __construct(SearchParams $params)
    {
        $this->params = $params;
    }

    public function from(int $from): static
    {
        $this->params->from = $from;

        return $this;
    }

    public function getParams(): SearchParams
    {
        return $this->params;
    }

    public function size(int $size): static
    {
        $this->params->size($size);

        return $this;
    }

    /**
     * @param Highlight $highlight the fields and settings for highlighting. Set to null to remove.
     */
    public function highlight(?Highlight $highlight): static
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * The query for the search.
     * array is supported for compatiblity and more complicated/unimplemented stuff.
     */
    public function query(array|Queryable $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function source(array|false|null $fields): static
    {
        $this->source = $fields;

        return $this;
    }

    /**
     * @param Sort[]|Sort $sort
     */
    public function sort(array|Sort $sort): static
    {
        if (is_array($sort)) {
            foreach ($sort as $s) {
                $this->addSort($s);
            }
        } else {
            $this->addSort($sort);
        }

        return $this;
    }

    public function type(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     *  Gets the actual size to use in queries.
     *
     * @return int actual size to use.
     */
    protected function getQuerySize(): int
    {
        return min($this->maxResults() - $this->params->from, $this->params->size);
    }

    protected function maxResults(): int
    {
        // the default is the maximum number of total results allowed when not using the scroll API.
        return 10000;
    }

    private function addSort(Sort $sort): void
    {
        if (!$sort->isBlank()) {
            $this->params->sorts[] = $sort;
        }
    }
}
