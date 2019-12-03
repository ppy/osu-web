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

use App\Exceptions\AuthorizationException;
use App\Exceptions\VerificationRequiredException;
use Illuminate\Auth\AuthenticationException;

class AuthorizationResult
{
    private $rawMessage;

    public function __construct($rawMessage)
    {
        $this->rawMessage = $rawMessage;
    }

    public function can()
    {
        return $this->rawMessage === 'ok';
    }

    public function rawMessage()
    {
        if ($this->can()) {
            return;
        }

        return presence($this->rawMessage, 'unauthorized');
    }

    public function requireLogin()
    {
        return $this->rawMessage() === 'require_login' ||
            ends_with($this->rawMessage(), '.require_login');
    }

    public function requireVerification()
    {
        return $this->rawMessage() === 'require_verification';
    }

    public function message()
    {
        if ($this->can()) {
            return;
        }

        return trans('authorization.'.$this->rawMessage());
    }

    public function ensureCan()
    {
        if ($this->can()) {
            return;
        }

        if ($this->requireLogin()) {
            $class = AuthenticationException::class;
        } elseif ($this->requireVerification()) {
            $class = VerificationRequiredException::class;
        } else {
            $class = AuthorizationException::class;
        }

        throw new $class($this->message());
    }
}
