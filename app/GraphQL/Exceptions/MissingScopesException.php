<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use App\GraphQL\ErrorCodes;

class MissingScopesException extends AuthorisationException
{
    protected $missingScopes;

    public function __construct($missingScopes = [])
    {
        parent::__construct(ErrorCodes::AUTH_MISSING_SCOPES);

        $this->missingScopes = $missingScopes;
    }

    public function extensionsContent(): array
    {
        return array_merge(parent::extensionsContent(), [
            'missingScopes' => $this->missingScopes,
        ]);
    }
}
