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
                '_' => "Telepítés: Amint egy csomag letöltődött, csomagold ki a .rar fájlt az osu! Songs mappába
Az összes pálya .zip és/vagy .osz kiterjesztésű, ezért mikor legközelebb kinyitod a játékot ezek a beatmapek kicsomagolódnak magába a játékba.
:scary csomagold ki a .zip/.osz fájlokat saját magadtól, különben a beatmapek hibásan fognak megjelenni és nem fognak megfelelően működni.",
                'scary' => 'NE',
            ],
            'note' => [
                '_' => 'Megjegyzés, hogy magasan ajánlott :scary mivel a régebbi pályák minősége sokkal alacsonyabb mint az újaké.',
                'scary' => 'letölteni a csomagokat a frissebektől, a régiekig',
            ],
        ],
        'title' => 'Beatmap csomag',
        'description' => 'Előre csomagolt beatmap kollekciók egy téma köré építve.',
    ],

    'show' => [
        'download' => 'Letöltés',
        'item' => [
            'cleared' => 'lejátszott',
            'not_cleared' => 'nem túlélt',
        ],
    ],

    'mode' => [
        'artist' => 'Előadó/Album',
        'chart' => 'Kiemeltek',
        'standard' => 'Standard',
        'theme' => 'Téma',
    ],

    'require_login' => [
        '_' => 'Be kell jelentkezned a letöltéshez! :link',
        'link_text' => 'bejelentkezve',
    ],
];
