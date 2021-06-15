<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

class UserProfilePageLookupException extends SilencedException
{
    private $render;

    public function __construct(callable $render)
    {
        $this->render = $render;
    }

    public function getResponse()
    {
        return ($this->render)();
    }
}
