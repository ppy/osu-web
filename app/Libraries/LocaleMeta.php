<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

class LocaleMeta
{
    const MAPPINGS = [
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
            'name' => 'Español',
            'flag' => 'ES',
        ],
        'fi' => [
            'name' => 'Suomi',
            'flag' => 'FI',
        ],
        'fr' => [
            'name' => 'Français',
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
            'name' => 'Polski',
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
        'ru' => [
            'name' => 'Русский',
            'flag' => 'RU',
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
        'zh' => [
            'name' => '中文',
            'flag' => 'CN',
        ],
        'zh-hk' => [
            'name' => '粤语',
            'flag' => 'HK',
        ],
        'zh-tw' => [
            'name' => '繁體中文',
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
