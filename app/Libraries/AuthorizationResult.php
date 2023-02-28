<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

        return osu_trans('authorization.'.$this->rawMessage());
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
