<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class ScoreRank
{
    const RANKS = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'];

    public static function isValid($value)
    {
        return in_array($value, static::RANKS, true);
    }
}
