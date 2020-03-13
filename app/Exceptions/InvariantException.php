<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

/**
 * Exception thrown when a domain method fails an invariant constraint check.
 * InvariantException::getMessage() should always be considered as safe for public.
 *
 * TODO: migrate more exceptions to this
 */
class InvariantException extends SilencedException
{
    public function getStatusCode()
    {
        return 422;
    }
}
