<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Events\UserSessionEvent;
use App\Exceptions\UserVerificationException;
use App\Libraries\Session\SessionManager;
use App\Models\LegacySession;
use App\Models\User;

class UserVerificationState
{
    protected $user;

    private $legacySession = [];
    private $legacySessionQueryWhere;
    private $session;

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
        $this->session = $session;
        $this->user = $user;

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
            cache()->forget("verification:{$previousLinkKey}");
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

        cache()->put("verification:{$linkKey}", $this->dump(), $expires);

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

    public function markVerified()
    {
        $this->session->forget('verification_expire_date');
        $this->session->forget('verification_tries');
        $this->session->forget('verification_key');
        $this->session->put('verified', true);
        $this->session->save();

        if ($this->legacySession() !== null) {
            $this->legacySession()->update(['verified' => true]);
        }

        UserSessionEvent::newVerified($this->user->getKey(), $this->session->getKey())->broadcast();
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
