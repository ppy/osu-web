<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
                'scary' => 'legújabb csomagok letöltése',
            ],
        ],
        'title' => 'Beatmap Csomagok',
        'description' => 'Előre csomagolt, általános témákat körbeölelő beatmap gyűjtemények.',
    ],

    'show' => [
        'back' => '',
        'download' => 'Letöltés',
        'item' => [
            'cleared' => 'lejátszott',
            'not_cleared' => 'nem játszott',
        ],
    ],

    'mode' => [
        'artist' => 'Előadó/Album',
        'chart' => 'Reflektorfény',
        'standard' => 'Standard',
        'theme' => 'Téma',
    ],

    'require_login' => [
        '_' => 'A letöltéshez :link kell lenned',
        'link_text' => 'bejelentkezve',
    ],
];
