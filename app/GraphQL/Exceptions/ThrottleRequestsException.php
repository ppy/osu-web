<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use GraphQL\Error\ClientAware;
use Illuminate\Http\Exceptions\ThrottleRequestsException as BaseThrottleRequestsException;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;
use Throwable;

class ThrottleRequestsException extends BaseThrottleRequestsException implements WrappedException, ClientAware, RendersErrorsExtensions
{
    protected int $retryIn;

    public function __construct(int $retryIn, Throwable $previous = null, array $headers = [])
    {
        parent::__construct(osu_trans('errors.codes.http-429'), $previous, $headers);
        $this->retryIn = $retryIn;
    }

    public function getCategory(): string
    {
        return 'ratelimit';
    }

    public function getGraphQLCode(): string
    {
        return 'RATELIMITED';
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function extensionsContent(): array
    {
        return [
            'code' => $this->getGraphQLCode(),
            'retryIn' => $this->retryIn,
        ];
    }

    public static function wrap(BaseThrottleRequestsException $e)
    {
        return new static($e->getHeaders()['Retry-After'], $e, $e->getHeaders());
    }
}
