<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

interface HasExtraExceptionData
{
    public function getContexts(): array;
    public function getExtras(): array;
}
