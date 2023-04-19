<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

class SearchResponse implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * @var array
     */
    private $raw;
    private $index;

    private $idField = '_id';
    private $recordType = null;

    public function __construct(array $results)
    {
        $this->raw = $results;

        $this->index = 0;
    }

    public function aggregations(string $name = null)
    {
        return $name === null
            ? $this->raw['aggregations'] ?? []
            : $this->raw['aggregations'][$name] ?? [];
    }

    public function count(): int
    {
        return count($this->hits());
    }

    public function hits()
    {
        return $this->raw['hits']['hits'];
    }

    /**
     * @return $this
     */
    public function idField($field)
    {
        $this->idField = $field;

        return $this;
    }

    /**
     * Returns an array of ids extracted from the search response.
     *
     * The _id field is the default field used for ids; a custom field can be
     * specified to be used as the id field instead. If a custom field is used,
     * the _source for that field must be included in the query.
     *
     * @param string $field The field to use as the id field.
     *
     * @return array
     */
    public function ids(string $field = null)
    {
        $field = $field ?? $this->idField;

        if ($field === '_id') {
            return array_map(function ($hit) use ($field) {
                return $hit[$field];
            }, $this->hits());
        } else {
            return array_map(function ($hit) use ($field) {
                return $hit['_source'][$field];
            }, $this->hits());
        }
    }

    public function innerHitsIds(string $name, string $field = null)
    {
        $ids = array_map(function ($hit) use ($name, $field) {
            return $hit->innerHits($name)->ids($field ?? $this->idField);
        }, iterator_to_array($this));

        return array_flatten($ids);
    }

    public function innerHitsRecords(string $name)
    {
        if ($this->recordType === null) {
            return;
        }

        $key = (new $this->recordType())->getKeyName();
        $ids = $this->innerHitsIds($name, $this->idField);

        return $this->recordType::whereIn($key, $ids)->orderByField($key, $ids);
    }

    public function raw()
    {
        return $this->raw;
    }

    public function records()
    {
        if ($this->recordType === null) {
            return;
        }

        $key = (new $this->recordType())->getKeyName();
        $ids = $this->ids($this->idField);

        return $this->recordType::whereIn($key, $ids)->orderByField($key, $ids);
    }

    /**
     * @return $this
     */
    public function recordType($class)
    {
        $this->recordType = $class;

        return $this;
    }

    public function total()
    {
        $total = $this->raw()['hits']['total'];

        // total an object in elasticsearch 7+
        return is_array($total) ? $total['value'] : $total;
    }

    //================
    // ArrayAccess
    //================

    public function offsetExists($key): bool
    {
        return array_has($this->hits(), $key);
    }

    public function offsetGet($key): mixed
    {
        return new Hit(data_get($this->hits(), $key));
    }

    public function offsetSet($key, $value): void
    {
        throw new \BadMethodCallException('not supported');
    }

    public function offsetUnset($key): void
    {
        throw new \BadMethodCallException('not supported');
    }

    //================
    // Iterator
    //================

    public function current(): mixed
    {
        return $this[$this->index];
    }

    public function key(): mixed
    {
        return $this->index;
    }

    public function next(): void
    {
        $this->index++;
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public function valid(): bool
    {
        return $this->offsetExists($this->index);
    }

    public static function empty()
    {
        return new static([
            'hits' => [
                'hits' => [],
                'total' => [
                    'relation' => 'eq',
                    'value' => 0,
                ],
            ],
        ]);
    }

    public static function failed($exception)
    {
        $ret = static::empty();
        $ret->raw['exception'] = $exception;

        return $ret;
    }
}
