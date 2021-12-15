<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use App\Exceptions\AuthorizationException as BaseAuthorizationException;
use GraphQL\Error\ClientAware;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class AuthorizationException extends BaseAuthorizationException implements ClientAware, RendersErrorsExtensions, WrappedException
{
    protected string $graphQLCode;

    public function __construct(string $message = 'Unauthorized.', string $graphQLCode = 'AUTH_UNAUTHORIZED')
    {
        parent::__construct($message);
        $this->graphQLCode = $graphQLCode;
    }

    public function getCategory(): string
    {
        return 'authorization';
    }

    public function getGraphQLCode(): string
    {
        return $this->graphQLCode;
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function extensionsContent(): array
    {
        return [
            'code' => $this->getGraphQLCode(),
        ];
    }

    public static function wrap(BaseAuthorizationException $e)
    {
        return new static($e->getMessage());
    }
}
