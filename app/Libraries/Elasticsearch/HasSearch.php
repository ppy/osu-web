<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

abstract class HasSearch
{
    protected $highlight;
    protected $params;
    protected $query;
    protected $source;
    protected $type;

    public function __construct(SearchParams $params)
    {
        $this->params = $params;
    }

    /**
     * @return $this
     */
    public function from(int $from)
    {
        $this->params->from = $from;

        return $this;
    }

    /**
     * @return SearchParams
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return $this
     */
    public function size(int $size)
    {
        $this->params->size($size);

        return $this;
    }

    /**
     * @param Highlight $highlight the fields and settings for highlighting. Set to null to remove.
     *
     * @return $this
     */
    public function highlight(?Highlight $highlight)
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * The query for the search.
     * array is supported for compatiblity and more complicated/unimplemented stuff.
     *
     * @param array|Queryable
     *
     * @return $this
     */
    public function query($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return $this
     */
    public function source($fields)
    {
        $this->source = $fields;

        return $this;
    }

    /**
     * @param Sort[]|Sort $sort
     *
     * @return $this
     */
    public function sort(array|Sort $sort)
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

    /**
     * @return $this
     */
    public function type(?string $type)
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

    private function addSort(Sort $sort)
    {
        if (!$sort->isBlank()) {
            $this->params->sorts[] = $sort;
        }
    }
}
