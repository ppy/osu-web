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
