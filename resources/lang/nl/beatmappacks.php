<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'no_diff_reduction' => [
            '_' => ':link kan niet worden gebruikt om dit pakket te wissen.',
            'link' => 'Mods voor moeilijkheidsvermindering',
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
