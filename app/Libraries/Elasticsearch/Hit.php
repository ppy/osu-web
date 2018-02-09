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

    public function innerHits(string $name)
    {
        $results = $this->raw['inner_hits'][$name] ?? null;

        if ($results) {
            return new SearchResponse($results, $name);
        }
    }

    public function raw()
    {
        return $this->raw;
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
