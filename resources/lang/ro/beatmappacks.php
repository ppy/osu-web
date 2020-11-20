<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Colecțiile pre-ambalate de beatmaps sunt bazate în jurul unei teme comune.',
        'nav_title' => 'listare',
        'title' => 'Pachete beatmap',

        'blurb' => [
            'important' => 'CITEȘTE ASTA ÎNAINTE DE A DESCĂRCA',
            'instruction' => [
                '_' => "Instalare: Odată ce un pachet a fost instalat, extrage fișierul .rar în folderul de melodii osu!.
                    Toate melodiile încă sunt de formă .zip și/sau .osz înăuntrul pachetului, deci osu! va trebui să extragă beatmap-urile de unul singur data viitoare când joci.
                    :scary extragi fișierele zip/osz de unul singur,
                    sau beatmap-urile vor fi afișate incorect în osu! și nu vor funcționa bine.",
                'scary' => 'Să NU',
            ],
            'note' => [
                '_' => 'De asemenea, reține că este foarte recomandat să :scary, din moment ce cele mai vechi mape sunt mult mai scăzute calitativ decât cele mai noi.',
                'scary' => 'descarci pachetele de la cele mai noi la cele mai vechi',
            ],
        ],
    ],

    'show' => [
        'download' => 'Descarcă',
        'item' => [
            'cleared' => 'eliminat',
            'not_cleared' => 'neeliminat',
        ],
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'În lumina reflectoarelor',
        'standard' => 'Standard',
        'theme' => 'Temă',
    ],

    'require_login' => [
        '_' => 'Trebuie să fii :link pentru a descărca',
        'link_text' => 'conectat',
    ],
];
