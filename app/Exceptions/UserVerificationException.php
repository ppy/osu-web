<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Exceptions;

class UserVerificationException extends InvariantException
{
    public function __construct(private string $reasonKey, private bool $shouldReissueMail)
    {
        parent::__construct(osu_trans("user_verification.errors.{$reasonKey}"));
    }

    public function reasonKey(): string
    {
        return $this->reasonKey;
    }

    public function shouldReissueMail(): bool
    {
        return $this->shouldReissueMail;
    }
}
