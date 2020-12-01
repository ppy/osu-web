<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class LocaleMeta
{
    const MAPPINGS = [
        'ar' => [
            'name' => 'اَلْعَرَبِيَّةُ‎',
            'flag' => 'SA',
        ],
        'be' => [
            'name' => 'Беларуская мова',
            'flag' => 'BY',
        ],
        'bg' => [
            'name' => 'Български',
            'flag' => 'BG',
        ],
        'cs' => [
            'name' => 'Česky',
            'flag' => 'CZ',
        ],
        'da' => [
            'name' => 'Dansk',
            'flag' => 'DK',
        ],
        'de' => [
            'name' => 'Deutsch',
            'flag' => 'DE',
        ],
        'el' => [
            'name' => 'Ελληνικά',
            'flag' => 'GR',
        ],
        'en' => [
            'name' => 'English',
            'flag' => 'GB',
        ],
        'es' => [
            'name' => 'español',
            'flag' => 'ES',
        ],
        'fi' => [
            'name' => 'Suomi',
            'flag' => 'FI',
        ],
        'fr' => [
            'name' => 'français',
            'flag' => 'FR',
        ],
        'hu' => [
            'name' => 'Magyar',
            'flag' => 'HU',
        ],
        'id' => [
            'name' => 'Bahasa Indonesia',
            'flag' => 'ID',
        ],
        'it' => [
            'name' => 'Italiano',
            'flag' => 'IT',
        ],
        'ja' => [
            'name' => '日本語',
            'flag' => 'JP',
        ],
        'ko' => [
            'name' => '한국어',
            'flag' => 'KR',
        ],
        'nl' => [
            'name' => 'Nederlands',
            'flag' => 'NL',
        ],
        'no' => [
            'name' => 'Norsk',
            'flag' => 'NO',
        ],
        'pl' => [
            'name' => 'polski',
            'flag' => 'PL',
        ],
        'pt' => [
            'name' => 'Português',
            'flag' => 'PT',
        ],
        'pt-br' => [
            'name' => 'Português (Brasil)',
            'flag' => 'BR',
        ],
        'ro' => [
            'name' => 'Română',
            'flag' => 'RO',
        ],
        'ru' => [
            'name' => 'Русский',
            'flag' => 'RU',
        ],
        'sk' => [
            'name' => 'Slovenčina',
            'flag' => 'SK',
        ],
        'sv' => [
            'name' => 'Svenska',
            'flag' => 'SE',
        ],
        'th' => [
            'name' => 'ไทย',
            'flag' => 'TH',
        ],
        'tl' => [
            'name' => 'Tagalog',
            'flag' => 'PH',
        ],
        'tr' => [
            'name' => 'Türkçe',
            'flag' => 'TR',
        ],
        'uk' => [
            'name' => 'Українська мова',
            'flag' => 'UA',
        ],
        'vi' => [
            'name' => 'Tiếng Việt',
            'flag' => 'VN',
        ],
        'zh' => [
            'name' => '简体中文',
            'flag' => 'CN',
        ],
        'zh-hk' => [
            'name' => '繁體中文（香港）',
            'flag' => 'HK',
        ],
        'zh-tw' => [
            'name' => '繁體中文（台灣）',
            'flag' => 'TW',
        ],
    ];

    const UNKNOWN = [
        'name' => '??',
        'flag' => '__',
    ];

    // doesn't actually return instance of this class :D
    public static function find($locale)
    {
        return static::MAPPINGS[static::sanitizeCode($locale)] ?? static::UNKNOWN;
    }

    public static function flagFor($locale)
    {
        return static::find($locale)['flag'];
    }

    public static function isValid($locale)
    {
        return isset(static::MAPPINGS[$locale]);
    }

    public static function nameFor($locale)
    {
        return static::find($locale)['name'];
    }

    public static function sanitizeCode($locale)
    {
        $ret = strtolower($locale);

        return isset(static::MAPPINGS[$ret]) ? $ret : null;
    }
}
