<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Multiplayer;

class Ruleset
{
    const OSU = 0;
    const TAIKO = 1;
    const CATCH = 2;
    const MANIA = 3;

    const ALL = [
        self::OSU,
        self::TAIKO,
        self::CATCH,
        self::MANIA,
    ];
}
