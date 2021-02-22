<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

/**
 * Wrapper around a SearchResponse hit to help make it
 * easier to iterate over a SearchResponse without crazy index nesting.
 */
class Hit implements \ArrayAccess
{
    /**
     * @var array
     */
    private $raw;

    public function __construct(array $raw)
    {
        $this->raw = $raw;
    }

    /**
     * Gets the highlights of the specified field, if any;
     * otherwise returns a html_excerpt of the _source field.
     *
     * If the end of the highlight is past the end of the cutoff,
     * the end of the highlight will be used as the cutoff instead.
     *
     * @param string $field name of the field to extract the highlight from.
     * @param int $limit length to cutoff the highlight fragment at.
     *
     * @return array
     */
    public function highlights(string $field, ?int $limit = null): array
    {
        if (isset($this['highlight'])) {
            $highlights = $this['highlight'][$field] ?? [];
            if ($limit === null) {
                return $highlights;
            }

            return array_map(function ($text) use ($limit) {
                // ensure cutoff is after the end of the highlight, if any.
                // TODO: look at storing offsets in index and using those to build highlights instead?
                $cap = strpos($text, '</em>') + 5;

                return str_limit($text, $cap === false ? $limit : max($cap, $limit));
            }, $highlights);
        }

        // highlights are stored in an array, so return an array as well.
        return [html_excerpt($this['_source'][$field] ?? '', $limit)];
    }

    public function innerHits(string $name)
    {
        $results = $this->raw['inner_hits'][$name] ?? null;

        if ($results) {
            return new SearchResponse($results, $name);
        }

        return SearchResponse::empty();
    }

    public function raw()
    {
        return $this->raw;
    }

    public function source($key = null)
    {
        if ($key === null) {
            return $this->raw['_source'] ?? null;
        }

        return ($this->raw['_source'] ?? null)[$key] ?? null;
    }

    //================
    // ArrayAccess
    //================

    public function offsetExists($key)
    {
        return array_has($this->raw, $key);
    }

    public function offsetGet($key)
    {
        return data_get($this->raw, $key);
    }

    public function offsetSet($key, $value)
    {
        throw new \BadMethodCallException('not supported');
    }

    public function offsetUnset($key)
    {
        throw new \BadMethodCallException('not supported');
    }
}
