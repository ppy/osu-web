<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'description' => 'Voorverpakte collecties van beatmaps gebaseerd rond een gedeeld thema.',
        'nav_title' => 'lijst',
        'title' => 'Beatmap Packs',

        'blurb' => [
            'important' => 'LEES DIT VOOR TE JE DOWNLOAD',
            'instruction' => [
                '_' => "Installatie: Eens een pack gedownload is, pak dan de .rar uit in je osu! Songs map.
                    Alle individuele beatmaps zijn nog in .zip of .osz formaat, dus osu! zal ze zelf uitpakken de volgende keer dat je in de Play mode gaat.
                    :scary de zip's/osz's zelf uitpakken,
                    of de beatmaps zullen incorrect in osu! worden weergegeven/niet werken.",
                'scary' => 'Ga NIET',
            ],
            'note' => [
                '_' => 'Merk ook op dat het is ten zeerste is aangeraden om :scary, omdat de oudste maps van mindere kwaliteit zijn dan de recentere maps.',
                'scary' => 'eerst de nieuwste packs te downloaden',
            ],
        ],
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => 'uitgespeeld',
            'not_cleared' => 'nog niet uitgespeeld',
        ],
    ],

    'mode' => [
        'artist' => 'Artiest/Album',
        'chart' => 'In de schijnwerpers',
        'standard' => 'Standaard',
        'theme' => 'Thema',
    ],

    'require_login' => [
        '_' => 'Je moet :link zijn om de downloaden',
        'link_text' => 'ingelogd',
    ],
];
