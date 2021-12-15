<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use GraphQL\Error\ClientAware;
use Laravel\Passport\Exceptions\MissingScopeException as BaseMissingScopeException;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class MissingScopeException extends BaseMissingScopeException implements ClientAware, RendersErrorsExtensions, WrappedException
{
    public function __construct($missingScopes = [])
    {
        parent::__construct($missingScopes);

        $this->missingScopes = $missingScopes;
    }

    public function getCategory(): string
    {
        return 'authentication';
    }

    public function getGraphQLCode(): string
    {
        return 'AUTH_MISSING_SCOPES';
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function extensionsContent(): array
    {
        return [
            'code' => $this->getGraphQLCode(),
            'missingScopes' => $this->missingScopes,
        ];
    }

    public static function wrap(BaseMissingScopeException $e)
    {
        return new static($e->scopes);
    }
}
