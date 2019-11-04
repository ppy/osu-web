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

use App\Models\UserClient;

class ClientVerificationState extends VerificationState
{
    /** @var string */
    private $clientHash;

    public static function fromCurrentRequest()
    {
        return new static(
            auth()->user(),
            session(),
            request('client_hash')
        );
    }

    private function __construct($user, $session, $clientHash = null)
    {
        parent::__construct($user, $session);

        if (present($clientHash)) {
            $this->session->put('client_hash', $clientHash);
        }

        if ($this->session->has('client_hash')) {
            $this->clientHash = $this->session->get('client_hash');
        }
    }

    public function isDone()
    {
        return UserClient::fromHash($this->user->user_id, $this->clientHash)->verified === true;
    }

    protected function onVerified()
    {
        $client = UserClient::fromHash($this->user->user_id, $this->clientHash);

        $client->verified = true;
        $client->save();

        $this->session->forget('client_hash');

        $user = UserVerificationState::fromCurrentRequest();

        if (!$user->isDone()) {
            // done in case the user wasn't logged in when starting the client verification
            // and is unverified, so that the verification flow doesn't happen twice
            $user->markVerified();
        }
    }

    public function verificationType()
    {
        return 'client';
    }
}
