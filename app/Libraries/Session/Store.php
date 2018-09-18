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

namespace App\Libraries\Session;

use App\Libraries\UserVerification;
use Auth;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Redis;

class Store extends \Illuminate\Session\Store
{
    public function keyPrefix(int $userId = null)
    {
        $userId = $userId ?? 'guest';

        return "sessions:{$userId}:";
    }

    public function destroyUserSession($sessionId)
    {
        if (Auth::check()) {
            $userId = Auth::user()->user_id;
            $this->handler->destroy($this->keyPrefix($userId).$sessionId);
        }
    }

    public function isCurrentSession($sessionId)
    {
        $prefix = Auth::check() ? Auth::user()->user_id : null;

        return $this->keyPrefix($prefix).$sessionId === $this->getId();
    }

    public function currentUserSessions()
    {
        if (Auth::check()) {
            if (config('session.driver') !== 'redis') {
                return [];
            }

            $userId = Auth::user()->user_id;

            // flush the current session data to redis early, otherwise the scan below will get stale metadata for the current session
            $this->save();

            $sessionIds = [];
            $cursor = 0;
            $keyPrefix = config('cache.prefix').':'.$this->keyPrefix($userId);
            do {
                list($cursor, $keys) = Redis::scan($cursor, 'match', "{$keyPrefix}*");
                $sessionIds = array_merge($sessionIds, $keys);
            } while ($cursor);
            $sessions = array_combine($sessionIds, Redis::mget($sessionIds));

            $sessionMeta = [];
            $agent = new Agent();
            foreach ($sessions as $id => $session) {
                // Sessions are stored in redis double-serialized for some reason...
                $session = unserialize(unserialize($session));

                $meta = $session['meta'];
                $agent->setUserAgent($meta['agent']);
                // strip keyPrefix
                $id = substr($id, -40);

                $sessionMeta[$id] = $meta;
                $sessionMeta[$id]['mobile'] = $agent->isMobile() || $agent->isTablet();
                $sessionMeta[$id]['device'] = $agent->device();
                $sessionMeta[$id]['browser'] = $agent->browser();
                $sessionMeta[$id]['verified'] = isset($session['verified']) && $session['verified'] === UserVerification::VERIFIED;
            }

            // returns sessions sorted from most to least recently active
            return array_reverse(array_sort($sessionMeta, function ($value) {
                return $value['last_visit'];
            }), true);
        }
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

        return $this->keyPrefix($userId).Str::random(40);
    }

    public function getIdWithoutPrefix()
    {
        return substr($this->getId(), -40);
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
            $this->handler->destroy($this->getId());
        }
        $this->setExists(false);
        $this->setId($this->generateSessionId($userId));

        return true;
    }
}
