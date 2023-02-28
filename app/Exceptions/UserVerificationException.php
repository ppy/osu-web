<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use Exception;

class UserVerificationException extends Exception
{
    private $reasonKey;
    private $shouldReissue;

    public function __construct(string $reasonKey, bool $shouldReissue)
    {
        $this->reasonKey = $reasonKey;
        $this->shouldReissue = $shouldReissue;

        $message = osu_trans("user_verification.errors.{$reasonKey}");

        parent::__construct($message);
    }

    public function reasonKey()
    {
        return $this->reasonKey;
    }

    public function shouldReissue()
    {
        return $this->shouldReissue;
    }
}
