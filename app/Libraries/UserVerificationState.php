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

use App\Exceptions\UserVerificationException;
use App\Libraries\Session\SessionManager;
use App\Models\LegacySession;
use App\Models\User;

class UserVerificationState
{
    const VERIFIED = 10;

    protected $user;

    private $legacySession = [];
    private $legacySessionQueryWhere;
    private $session;

    public static function fromCurrentRequest()
    {
        return new static([
            'user' => auth()->user(),
            'session' => session(),
            'legacySessionQueryWhere' => LegacySession::queryWhereFromRequest(request()),
        ]);
    }

    public static function fromVerifyLink($linkKey)
    {
        $params = cache()->get("verifications:{$linkKey}");

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

        return new static([
            'user' => User::find($params['userId']),
            'session' => $session,
            'legacySessionQueryWhere' => $params['legacySessionQueryWhere'],
        ]);
    }

    public function __construct(array $params)
    {
        $this->user = $params['user'];
        $this->session = $params['session'];
        $this->legacySessionQueryWhere = $params['legacySessionQueryWhere'];

        if ($this->session->getId() === session()->getId()) {
            // Override passed session if it's the same as current session
            // otherwise the changes here will be overriden when current
            // session is saved.
            $this->session = session();
        }
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
        $previousLinkKey = $this->session->get('verification_link_key');

        if (present($previousLinkKey)) {
            cache()->forget("verification:{$linkKey}");
        }

        // 1 byte = 2^8 bits = 16^2 bits = 2 hex characters
        $key = bin2hex(random_bytes(config('osu.user.verification_key_length_hex') / 2));
        $linkKey = bin2hex(random_bytes(32));
        $expires = now()->addHours(5);

        $this->session->put('verification_key', $key);
        $this->session->put('verification_link_key', $linkKey);
        $this->session->put('verification_expire_date', $expires);
        $this->session->put('verification_tries', 0);
        $this->session->save();

        cache()->put("verifications:{$linkKey}", $this->dump(), $expires);

        return [
            'link' => $linkKey,
            'main' => $key,
        ];
    }

    public function issued()
    {
        return present($this->session->get('verification_key'));
    }

    public function isDone()
    {
        if ($this->user === null) {
            return true;
        }

        if ($this->session->get('verified') === static::VERIFIED) {
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
                ->where(['user_id' => $this->user->getKey()])
                ->first();
        }

        return $this->legacySession['value'];
    }

    public function markVerified()
    {
        $this->session->forget('verification_expire_date');
        $this->session->forget('verification_tries');
        $this->session->forget('verification_key');
        $this->session->put('verified', static::VERIFIED);
        $this->session->save();

        if ($this->legacySession() !== null) {
            $this->legacySession()->update(['verified' => true]);
        }
    }

    public function verify($inputKey)
    {
        if ($this->isDone()) {
            return;
        }

        $expireDate = $this->session->get('verification_expire_date');
        $tries = $this->session->get('verification_tries');
        $key = $this->session->get('verification_key');

        if (!present($expireDate) || !present($tries) || !present($key)) {
            throw new UserVerificationException('expired', true);
        }

        if ($expireDate->isPast()) {
            throw new UserVerificationException('expired', true);
        }

        if ($tries > config('osu.user.verification_key_tries_limit')) {
            throw new UserVerificationException('retries_exceeded', true);
        }

        if (!hash_equals($key, $inputKey)) {
            $this->session->put('verification_tries', $tries + 1);
            $this->session->save();

            throw new UserVerificationException('incorrect_key', false);
        }
    }
}
