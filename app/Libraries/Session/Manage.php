<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Libraries\Session;

use LaravelRedis as Redis;

class Manage
{
    public static function destroy($userId)
    {
        if (!static::isUsingRedis()) {
            return;
        }

        Redis::del(array_merge([static::listKey($userId)], static::keys($userId)));
    }

    public static function isUsingRedis()
    {
        return config('session.driver') === 'redis';
    }

    /**
     * Get the redis key prefix for the given user (excluding cache prefix).
     *
     * @return string
     */
    public static function keyPrefix($userId)
    {
        return 'sessions:'.$userId ?? 'guest';
    }

    public static function keys($userId)
    {
        if (!static::isUsingRedis()) {
            return [];
        }

        return Redis::smembers(static::listKey($userId));
    }

    /**
     * Get the redis key containing the session list for the given user.
     *
     * @return string
     */
    public static function listKey($userId)
    {
        return config('cache.prefix').':'.static::keyPrefix($userId);
    }

    public static function removeFullId($userId, $fullId)
    {
        return static::removeKey($userId, config('cache.prefix').':'.$fullId);
    }

    public static function removeKey($userId, $key)
    {
        if (!static::isUsingRedis()) {
            return;
        }

        Redis::srem(static::listKey($userId), $key);
    }
}
