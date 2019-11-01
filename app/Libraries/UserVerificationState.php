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

namespace App\Libraries;

use App\Libraries\Session\SessionManager;
use App\Models\LegacySession;
use App\Models\User;

class UserVerificationState extends VerificationState
{
    private $legacySession = [];
    private $legacySessionQueryWhere;

    public static function fromCurrentRequest()
    {
        return new static(
            auth()->user(),
            session(),
            LegacySession::queryWhereFromRequest(request())
        );
    }

    public static function fromVerifyLink($linkKey)
    {
        $params = cache()->get("verification:{$linkKey}");

        if ($params !== null) {
            $state = static::load($params);

            // As it's from verify link, make sure the state is waiting for verification.
            if ($state->issued()) {
                return $state;
            }
        }
    }

    public static function load($params)
    {
        $session = new SessionManager(app());
        $session->setId($params['sessionId']);
        $session->start();

        return new static(
            User::find($params['userId']),
            $session,
            $params['legacySessionQueryWhere']
        );
    }

    private function __construct($user, $session, $legacySessionQueryWhere)
    {
        $this->legacySessionQueryWhere = $legacySessionQueryWhere;

        parent::__construct($user, $session);
    }

    public function dump()
    {
        return [
            'userId' => $this->user->getKey(),
            'sessionId' => $this->session->getId(),
            'legacySessionQueryWhere' => $this->legacySessionQueryWhere,
        ];
    }

    public function issue()
    {
        $keys = parent::issue();

        $previousLinkKey = $this->session->get('verification_link_key');

        if (present($previousLinkKey)) {
            cache()->forget("verification:{$previousLinkKey}");
        }

        $linkKey = bin2hex(random_bytes(32));
        $expires = $this->session->get('verification_expire_date');

        $this->session->put('verification_link_key', $linkKey);
        $this->session->save();

        cache()->put("verification:{$linkKey}", $this->dump(), $expires);

        $keys['link'] = $linkKey;

        return $keys;
    }

    /**
     * {@inheritdoc}
     */
    protected function onVerified()
    {
        $this->session->put('verified', true);

        if ($this->legacySession() !== null) {
            $this->legacySession()->update(['verified' => true]);
        }
    }

    public function verificationType()
    {
        return 'user';
    }

    public function isDone()
    {
        if ($this->user === null) {
            return true;
        }

        if ($this->session->get('verified')) {
            return true;
        }

        if ($this->isDoneLegacy()) {
            $this->markVerified();

            return true;
        }

        return false;
    }

    public function isDoneLegacy()
    {
        return $this->legacySession() !== null
            && $this->legacySession()->verified;
    }

    public function legacySession()
    {
        if ($this->legacySessionQueryWhere === null) {
            return;
        }

        if (!array_key_exists('value', $this->legacySession)) {
            $this->legacySession['value'] = LegacySession
                ::where($this->legacySessionQueryWhere)
                ->where(['session_user_id' => $this->user->getKey()])
                ->first();
        }

        return $this->legacySession['value'];
    }
}
