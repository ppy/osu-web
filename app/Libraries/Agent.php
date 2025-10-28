<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Detection\MobileDetect;

class Agent extends MobileDetect
{
    private static array $additionalOperatingSystems = [
        'Windows' => 'Windows|Windows NT [VER]',
        'OS X' => 'Mac OS X|OS X [VER]',
        'Linux' => 'Linux',
    ];

    #[\Override]
    public function getRules(): array
    {
        static $rules = [
            ...static::$browsers,
            ...static::$operatingSystems,
            ...static::$phoneDevices,
            ...static::$tabletDevices,
            ...static::$additionalOperatingSystems,
        ];

        return $rules;
    }
}
