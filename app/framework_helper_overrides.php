<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// Fixes laravel/framework#12065.
function e($value)
{
    if ($value instanceof Illuminate\Contracts\Support\Htmlable) {
        return $value->toHtml();
    }

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', true);
}
