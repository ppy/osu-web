<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Detection\MobileDetect;

class Agent extends MobileDetect
{
    // extra list of desktop browsers for matching.
    private static array $additionalBrowsers = [
        'Opera Mini' => 'Opera Mini',
        'Opera' => 'Opera|OPR',
        'Edge' => 'Edge|Edg',
        'Coc Coc' => 'coc_coc_browser',
        'UCBrowser' => 'UCBrowser',
        'Vivaldi' => 'Vivaldi',
        'Chrome' => 'Chrome',
        'Firefox' => 'Firefox',
        'Safari' => 'Safari',
        'IE' => 'MSIE|IEMobile|MSIEMobile|Trident/[.0-9]+',
        'Netscape' => 'Netscape',
        'Mozilla' => 'Mozilla',
        'WeChat'  => 'MicroMessenger',
    ];

    // extra matches for non-mobile platforms.
    private static array $additionalOperatingSystems = [
        'Windows' => 'Windows|Windows NT [VER]',
        'OS X' => 'Mac OS X|OS X [VER]',
        'Linux' => 'Linux',
        'Debian' => 'Debian',
        'Ubuntu' => 'Ubuntu',
        'OpenBSD' => 'OpenBSD',
        'ChromeOS' => 'CrOS',
    ];

    private static function mergeRules(array $base, array ...$moreRules): array
    {
        $merged = $base;
        foreach ($moreRules as $rules) {
            foreach ($rules as $key => $value) {
                if (empty($merged[$key])) {
                    $merged[$key] = $value;
                } elseif (is_array($merged[$key])) {
                    $merged[$key][] = $value;
                } else {
                    $merged[$key] .= '|'.$value;
                }
            }
        }

        return $merged;
    }

    public function browser(): ?string
    {
        return $this->findRuleFromUserAgent(static::getBrowsers());
    }

    public function device(): ?string
    {
        static $rules = static::mergeRules(
            static::$phoneDevices,
            static::$tabletDevices,
        );

        return $this->findRuleFromUserAgent($rules);
    }

    #[\Override]
    public static function getBrowsers(): array
    {
        static $rules = static::mergeRules(
            static::$additionalBrowsers,
            static::$browsers,
        );

        return $rules;
    }

    public function isPlatform(string $platform): bool
    {
        return $this->platform() === $platform;
    }

    public function findRuleFromUserAgent(array $rules): ?string
    {
        $userAgent = $this->userAgent;

        foreach ($rules as $key => $regex) {
            if (empty($regex)) {
                continue;
            }

            if (is_array($regex)) {
                foreach ($regex as $regexString) {
                    if ($this->match($regexString, $userAgent)) {
                        return $key;
                    }
                }
            } else {
                if ($this->match($regex, $userAgent)) {
                    return $key;
                }
            }
        }

        return null;
    }

    public function platform(): ?string
    {
        static $rules = static::mergeRules(
            static::$operatingSystems,
            static::$additionalOperatingSystems,
        );

        return $this->findRuleFromUserAgent($rules);
    }
}
