<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries\Search;

use BadMethodCallException;
use ReflectionObject;

/**
 * Compatibility trait for Search classes during cleanup.
 */
trait HasCompatibility
{
    public function params()
    {
        return $this->getPaginationParams();
    }

    // ArrayAccess

    public function offsetExists($key)
    {
        return in_array($key, ['data', 'total', 'params'], true);
    }

    public function offsetGet($key)
    {
        if ($this->offsetExists($key) === false) {
            return;
        }

        // reroute to method
        return (new ReflectionObject($this))->getMethod(camel_case($key))->invoke($this);
    }

    public function offsetSet($key, $value)
    {
        throw new BadMethodCallException('not supported');
    }

    public function offsetUnset($key)
    {
        throw new BadMethodCallException('not supported');
    }
}
