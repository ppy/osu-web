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

use Illuminate\Support\Str;

class Store extends \Illuminate\Session\Store
{
    public function keyPrefix(int $userId = null)
    {
        $userId = $userId ?? 'guest';

        return "sessions:{$userId}:";
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
