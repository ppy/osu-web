<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
        'en' => [
            'name' => 'English',
            'flag' => 'GB',
        ],
        'es' => [
            'name' => 'Español',
            'flag' => 'ES',
        ],
        'fr' => [
            'name' => 'Français',
            'flag' => 'FR',
        ],
        'it' => [
            'name' => 'Italiano',
            'flag' => 'IT',
        ],
        'nl' => [
            'name' => 'Nederlands',
            'flag' => 'NL',
        ],
        'pl' => [
            'name' => 'Polski',
            'flag' => 'PL',
        ],
        'pt-br' => [
            'name' => 'Português (Brasil)',
            'flag' => 'BR',
        ],
    ];

    public static function flagFor($locale)
    {
        return static::MAPPINGS[$locale]['flag'] ?? '__';
    }

    public static function nameFor($locale)
    {
        return static::MAPPINGS[$locale]['name'] ?? '??';
    }
}
