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

use ReflectionObject;

class RecordSearch extends Search implements \ArrayAccess
{
    protected $recordType;

    public function __construct(string $index, $type, array $options = [])
    {
        parent::__construct($index, $options);
        $this->recordType = $type;
    }

    public function data()
    {
        return $this->records();
    }

    public function over_limit()
    {
        return $this->response()->total() > static::MAX_RESULTS;
    }

    public function params()
    {
        return $this->getPageParams();
    }

    public function records()
    {
        return $this->response()->records()->get();
    }

    public function response() : SearchResponse
    {
        return parent::response()->recordType($this->recordType);
    }

    public function total()
    {
        return min($this->response()->total(), static::MAX_RESULTS);
    }

    //================
    // ArrayAccess
    //================

    public function offsetExists($key)
    {
        return in_array($key, ['data', 'total', 'over_limit', 'params'], true);
    }

    public function offsetGet($key)
    {
        if ($this->offsetExists($key) === false) {
            return null;
        }

        // reroute to method
        return (new ReflectionObject($this))->getMethod($key)->invoke($this);
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
