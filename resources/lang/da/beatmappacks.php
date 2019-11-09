<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'READ THIS BEFORE DOWNLOADING',
            'instruction' => [
                '_' => "Installation: Så snart at en pakke er blevet hentet, skal du udpakke .rar-filen i dit osu! sangbibliotek.
                    Alle sangene er stadig i .zip og/eller .osz format indeni pakken, så osu! bliver nødt til at udpakke beatmaps'ne selv næste gang du går ind i Play mode.
                    :scary udpak .zip/.osz-filerne selv,
                    ellers vil beatmaps'ne fremstå forkert i osu og vil ikke fungere korrekt.",
                'scary' => 'ALDRIG',
            ],
            'note' => [
                '_' => 'Vær opmærksom på, at det er stærkt anbefalet at :scary, eftersom, at de ældre beatmaps er meget ringere kvalitet i forhold til de nyere beatmaps.',
                'scary' => 'downloade pakkerne fra nyeste til ældste',
            ],
        ],
        'title' => 'Beatmap Packs',
        'description' => 'Forhåndslavede samlinger af beatmaps baseret på det samme tema.',
    ],

    'show' => [
        'back' => '',
        'download' => 'Download',
        'item' => [
            'cleared' => 'cleared',
            'not_cleared' => 'not cleared',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'Chart',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du skal være :link for at kunne downloade',
        'link_text' => 'logget ind',
    ],
];
