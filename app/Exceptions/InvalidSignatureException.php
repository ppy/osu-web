<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use Exception;

class InvalidSignatureException extends Exception implements HasExtraExceptionData
{
    public function __construct(string $message = '', private array $extras = [])
    {
        parent::__construct($message);
    }

    public function getContexts(): array
    {
        return [];
    }

    public function getExtras(): array
    {
        return $this->extras;
    }
}
