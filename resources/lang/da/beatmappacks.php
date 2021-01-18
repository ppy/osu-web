<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Færdigpakkede samlinger af beatmaps bygget op omkring et fælles tema.',
        'nav_title' => 'katalog',
        'title' => 'Beatmap Pakker',

        'blurb' => [
            'important' => 'LÆS DETTE FØR DU DOWNLOADER',
            'instruction' => [
                '_' => "Installation: Så snart en pakke er hentet, skal du pakke .rar-filen ud i dit osu! sangbibliotek.
                    Alle sangene er stadig i .zip og/eller .osz format indeni pakken, så osu! bliver nødt til at udpakke beatmapsene næste gang du går ind i Play mode.
                    Udpak :scary .zip/.osz-filerne selv,
                    ellers vil beatmapsene fremstå forkert i osu! og vil ikke fungere korrekt.",
                'scary' => 'ALDRIG',
            ],
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
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du skal være :link for at kunne downloade',
        'link_text' => 'logget ind',
    ],
];
