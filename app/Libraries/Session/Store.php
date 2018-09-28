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

namespace App\Libraries\Session;

use App\Libraries\UserVerification;
use Auth;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Redis;

class Store extends \Illuminate\Session\Store
{
    const SESSION_ID_LENGTH = 40;

    /**
     * Get the redis key prefix for the given user (excluding cache prefix).
     *
     * @return string
     */
    protected static function keyPrefix(int $userId = null)
    {
        $userId = $userId ?? 'guest';

        return "sessions:{$userId}";
    }

    /**
     * Get the redis key containing the session list for the given user.
     *
     * @return string
     */
    protected static function sessionListKey(int $userId = null)
    {
        return config('cache.prefix').':'.static::keyPrefix($userId);
    }

    /**
     * Get the redis key prefix of the current session (excluding cache prefix).
     *
     * @return string
     */
    protected function getCurrentKeyPrefix()
    {
        $sessionId = $this->getId();

        return substr($sessionId, 0, strlen($sessionId) - static::SESSION_ID_LENGTH - 1);
    }

    /**
     * Destroys a session owned by the current user that is identified by the given id.
     *
     * @return bool
     */
    public function destroyUserSession($sessionId)
    {
        if (Auth::check()) {
            $userId = Auth::user()->user_id;
            $fullSessionId = static::keyPrefix($userId).':'.$sessionId;
            $this->handler->destroy($fullSessionId);

            Redis::srem(static::sessionListKey($userId), config('cache.prefix').':'.$fullSessionId);

            return true;
        }

        return false;
    }

    /**
     * Return whether the given id matches the current session's id.
     *
     * @return bool
     */
    public function isCurrentSession($sessionId)
    {
        return $this->getIdWithoutKeyPrefix() === $this->stripKeyPrefix($sessionId);
    }

    /**
     * Returns whether the current session is a guest session based on the key prefix of the session id.
     *
     * @return bool
     */
    public function isGuestSession()
    {
        return starts_with($this->getId(), static::keyPrefix(null).':');
    }

    public function currentUserSessions()
    {
        if (!Auth::check()) {
            return;
        }

        if (config('session.driver') !== 'redis') {
            return [];
        }

        $userId = Auth::user()->user_id;

        // flush the current session data to redis early, otherwise we will get stale metadata for the current session
        $this->save();

        // TODO: When(if?) the session driver config is decoupled from the cache driver config, update the prefix below:
        $sessionIds = Redis::smembers(static::sessionListKey($userId));
        if (empty($sessionIds)) {
            return [];
        }

        $sessions = array_combine($sessionIds, Redis::mget($sessionIds));

        $sessionMeta = [];
        $agent = new Agent();
        foreach ($sessions as $id => $session) {
            if ($session === null) {
                // cleanup expired sessions
                Redis::srem(static::sessionListKey($userId), $id);
                continue;
            }
            // Sessions are stored double-serialized in redis (session serialization + cache backend serialization)
            $session = unserialize(unserialize($session));

            if (!isset($session['meta'])) {
                continue;
            }

            $meta = $session['meta'];
            $agent->setUserAgent($meta['agent']);
            $id = $this->stripKeyPrefix($id);

            $sessionMeta[$id] = $meta;
            $sessionMeta[$id]['mobile'] = $agent->isMobile() || $agent->isTablet();
            $sessionMeta[$id]['device'] = $agent->device();
            $sessionMeta[$id]['platform'] = $agent->platform();
            $sessionMeta[$id]['browser'] = $agent->browser();
            $sessionMeta[$id]['verified'] = isset($session['verified']) && $session['verified'] === UserVerification::VERIFIED;
        }

        // returns sessions sorted from most to least recently active
        return array_reverse(array_sort($sessionMeta, function ($value) {
            return $value['last_visit'];
        }), true);
    }

    /**
     * Determine if this is a valid session ID.
     *
     * @param  string  $id
     * @return bool
     */
    public function isValidId($id)
    {
        // Overriden to allow using symbols for namespacing the keys in redis

        return is_string($id);
    }

    /**
     * Get a new, random session ID.
     *
     * @return string
     */
    protected function generateSessionId(int $userId = null)
    {
        // Overriden to allow namespacing the session id (used as the redis key)

        return static::keyPrefix($userId).':'.Str::random(static::SESSION_ID_LENGTH);
    }

    public function getIdWithoutKeyPrefix()
    {
        return $this->stripKeyPrefix($this->getId());
    }

    /**
     * Returns the session id without the key prefix.
     *
     * @return string
     */
    protected function stripKeyPrefix($sessionId)
    {
        return substr($sessionId, -static::SESSION_ID_LENGTH);
    }

    /**
     * Generate a new session ID for the session.
     *
     * @param  bool  $destroy
     * @param  string  $sessionId
     * @return bool
     */
    public function migrate($destroy = false, int $userId = null)
    {
        // Overriden to allow passing through $userId to namespace session ids

        if ($destroy) {
            if (!$this->isGuestSession()) {
                Redis::srem(static::sessionListKey($userId), config('cache.prefix').':'.$this->getId());
            }
            $this->handler->destroy($this->getId());
        }
        $this->setExists(false);
        $this->setId($this->generateSessionId($userId));

        return true;
    }

    /**
     * Read the session data from the handler.
     *
     * @return array
     */
    protected function readFromHandler()
    {
        // Overridden to force session ids to be regenerated when trying to load a session that doesn't exist anymore

        if ($data = $this->handler->read($this->getId())) {
            $data = @unserialize($this->prepareForUnserialize($data));

            if ($data !== false && !is_null($data) && is_array($data)) {
                return $data;
            }
        }

        $this->regenerate(true);

        return [];
    }

    /**
     * Save the session data to storage.
     */
    public function save()
    {
        // Overriden to track user sessions in Redis
        parent::save();

        if (!$this->isGuestSession()) {
            Redis::sadd(config('cache.prefix').':'.$this->getCurrentKeyPrefix(), config('cache.prefix').':'.$this->getId());
        }
    }
}
