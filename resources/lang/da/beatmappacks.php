<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Færdigpakkede samlinger af beatmaps bygget op omkring et fælles tema.',
        'empty' => '',
        'nav_title' => 'katalog',
        'title' => 'Beatmap Pakker',

        'blurb' => [
            'important' => 'LÆS DETTE FØR DU DOWNLOADER',
            'install_instruction' => 'Installation: Når en pakke er blevet downloadet, udtrække indholdet af pakken i din osu! Sange mappe og osu! vil gøre resten.',
            'note' => [
                '_' => 'Vær opmærksom på, at det er stærkt anbefalet at :scary, eftersom ældre beatmaps er meget ringere kvalitet i forhold til nyere beatmaps.',
                'scary' => 'hente pakker fra nyest til ældst',
            ],
        ],
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => 'ryddet',
            'not_cleared' => 'ikke ryddet',
        ],
        'no_diff_reduction' => [
            '_' => ':link må ikke bruges til at rydde denne pakke.',
            'link' => 'Sværhedsgrad reduktion modifikationer',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'Spotlights',
        'featured' => '',
        'standard' => 'Standard',
        'theme' => 'Tema',
        'tournament' => 'Turnering',
    ],

    'require_login' => [
        '_' => 'Du skal være :link for at kunne downloade',
        'link_text' => 'logget ind',
    ],
];
