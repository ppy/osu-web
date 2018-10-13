<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

return [
    'index' => [
        'blurb' => [
            'important' => 'OLVASD EL LETÖLTÉS ELŐTT',
            'instruction' => [
                '_' => "Telepítés: Amint egy csomag letöltődött, csomagold ki a .rar fájlt az osu! Songs mappába.
Mivel az összes szám .zip és/vagy .osz kiterjesztésű, ezért a következő Play módba lépéskor ezek a beatmapek ki lesznek csomagolva.
:scary csomagold ki a .zip/.osz fájlokat saját magadtól, különben a beatmapek hibásan jelenhetnek meg és nem fognak megfelelően működni.",
                'scary' => 'NE',
            ],
            'note' => [
                '_' => 'Valamint vedd figyelembe, hogy erősen javasolt a :scary, mivel a régebbi pályák minősége jóval alacsonyabb az újakéhoz képest.',
                'scary' => 'a legújabb pályák letöltése',
            ],
        ],
        'title' => 'Beatmap Csomagok',
        'description' => 'Előre csomagolt közös témájú beatmap kollekciók.',
    ],

    'show' => [
        'download' => 'Letöltés',
        'item' => [
            'cleared' => 'lejátszott',
            'not_cleared' => 'kijátszatlan',
        ],
    ],

    'mode' => [
        'artist' => 'Előadó/Album',
        'chart' => 'Kiemeltek',
        'standard' => 'Standard',
        'theme' => 'Téma',
    ],

    'require_login' => [
        '_' => 'A letöltéshez :link kell lenned',
        'link_text' => 'bejelentkezve',
    ],
];
