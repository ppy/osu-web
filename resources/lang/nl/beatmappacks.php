<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Voorverpakte collecties van beatmaps rond een bepaald thema.',
        'nav_title' => 'lijst',
        'title' => 'Beatmap Packs',

        'blurb' => [
            'important' => 'LEES DIT VOORALEER JE PACKS DOWNLOADT',
            'install_instruction' => 'Hoe installeren: Wanneer het downloaden van een pack voltooid is, pak je de inhoud uit naar je osu! Songs-map. osu! doet de rest.',
            'note' => [
                '_' => 'Houd er ook rekening mee dat het sterk aanbevolen is om :scary. Oudere beatmaps zijn vaak minder kwaliteitsvol.',
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
            '_' => 'Om dit pack uit te spelen, mogen :link niet gebruikt worden.',
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
