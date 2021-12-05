<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

class AuthorisationException extends BaseException
{
    public function __construct(array $code, string $message = 'Authorisation error', int $httpCode = 403)
    {
        parent::__construct($code, $message, $httpCode);
    }

    public function getCategory(): string
    {
        return 'auth';
    }
}
