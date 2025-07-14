<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Exceptions;

class RequestTooLargeException extends InvariantException
{
    public function __construct(string $name, int $limit)
    {
        parent::__construct(osu_trans_choice('errors.param_too_large', $limit, ['name' => $name]));
    }
}
