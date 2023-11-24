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

    public const NULL = -1;

    public static function tryFromName(?string $ruleset): ?self
    {
        if ($ruleset === null) {
            return null;
        }

        static $lookupMap;
        if ($lookupMap === null) {
            $lookupMap = [];
            foreach (self::cases() as $r) {
                $lookupMap[$r->name] = $r;
            }
            $lookupMap['fruits'] = self::catch;
        }

        return $lookupMap[$ruleset] ?? null;
    }

    public function legacyName()
    {
        return $this === self::catch
            ? 'fruits'
            : $this->name;
    }
}
