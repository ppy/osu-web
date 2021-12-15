<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use GraphQL\Error\ClientAware;
use Illuminate\Auth\AuthenticationException as BaseAuthenticationException;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class AuthenticationException extends BaseAuthenticationException implements ClientAware, RendersErrorsExtensions, WrappedException
{
    protected string $graphQLCode;

    public function __construct(string $message = null, string $graphQLCode = 'AUTH_UNAUTHENTICATED')
    {
        parent::__construct($message);
        $this->graphQLCode = $graphQLCode;
    }

    public function getCategory(): string
    {
        return 'authentication';
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

    public static function wrap(BaseAuthenticationException $e)
    {
        return new static($e->getMessage());
    }
}
