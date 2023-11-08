<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Enums;

enum Ruleset: int
{
    case osu = 0;
    case taiko = 1;
    case catch = 2;
    case mania = 3;

    public static function fromName(string $ruleset): self
    {
        static $lookupMap;
        if ($lookupMap === null) {
            $lookupMap = [];
            foreach (self::cases() as $r) {
                $lookupMap[$r->name] = $r;
            }
        }

        return $lookupMap[$ruleset];
    }
}
