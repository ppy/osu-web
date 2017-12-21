<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'important' => 'READ THIS BEFORE DOWNLOADING',
            'instruction' => [
                '_' => "Installation: Så snart at en pakke er blevet hentet, skal du udpakke .rar-filen i dit osu! sangbibliotek.
                    Alle sangene er stadig i .zip og/eller .osz format indeni pakken, så osu! bliver nødt til at udpakke beatmaps'ne selv næste gang du går ind i Play mode.
                    :scary udpak .zip/.osz-filerne selv,
                    ellers vil beatmaps'ne fremstå forkert i osu og vil ikke fungere korrekt.",
                'scary' => 'ALDRIG',
            ],
            'note' => [
                '_' => 'Vær opmærksom på, at det er stærkt anbefalet at :scary, eftersom, at de ældre baner er meget ringere kvalitet i forhold til de nyere beatmaps.',
                'scary' => 'downloade pakkerne fra nyeste til ældste',
            ],
        ],
        'title' => 'Beatmap Packs',
        'description' => 'Forhåndslavede samlinger af beatmaps med nogenlunde samme tema.',
    ],

    'show' => [
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
