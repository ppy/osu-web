<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries\Elasticsearch;

class SearchResults implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * @var string
     */
    private $container;

    /**
     * @var string
     */
    private $innerHitsName;

    /**
     * @var array
     */
    private $results;

    private $index;

    public function __construct(array $results, ?string $innerHitsName = null)
    {
        $this->innerHitsName = $innerHitsName;
        $this->results = $results;

        $this->index = 0;
    }

    public function hits()
    {
        return $this->results['hits']['hits'];
    }

    public function innerHits($index)
    {
        $results = $this->hits()[$index] ?? null;
        $results = $results['inner_hits'][$this->innerHitsName];

        if ($results) {
            return new static($results, $this->innerHitsName);
        }
    }

    public function raw()
    {
        return $this->results;
    }

    public function count()
    {
        return count($this->hits());
    }

    public function offsetExists($key)
    {
        return array_has($this->hits(), $key);
    }

    public function offsetGet($key)
    {
        return data_get($this->hits(), $key);
    }

    public function offsetSet($key, $value)
    {
        throw new \BadMethodCallException('not supported');
    }

    public function offsetUnset($key)
    {
        throw new \BadMethodCallException('not supported');
    }

    public function current()
    {
        return $this[$this->index];
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        ++$this->index;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function valid()
    {
        return $this->offsetExists($this->index);
    }
}
