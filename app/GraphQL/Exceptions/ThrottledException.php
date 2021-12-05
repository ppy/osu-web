<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Exceptions;

use App\GraphQL\ErrorCodes;

class ThrottledException extends BaseException
{
    protected $availableIn;

    public function __construct(int $availableIn, string $message = 'Rate limited')
    {
        parent::__construct(ErrorCodes::RATELIMITED, $message, 429);

        $this->availableIn = $availableIn;
    }

    public function getCategory(): string
    {
        return 'ratelimit';
    }

    public function extensionsContent(): array
    {
        return array_merge(parent::extensionsContent(), [
            'availableIn' => $this->availableIn,
        ]);
    }
}
