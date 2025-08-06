<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Vybraní umelci v osu!',
    'title' => 'Vybraní umelci',

    'admin' => [
        'hidden' => 'UMELEC JE MOMENTÁLNE SKRYTÝ',
    ],

    'beatmaps' => [
        '_' => 'Beatmapy',
        'download' => 'Stiahnuť Šablónu Beatmapy',
        'download-na' => 'Beatmapová šablóna zatiaľ nie je dostupná',
    ],

    'index' => [
        'description' => 'Vybraní umelci sú umelci, s ktorými spolupracujeme, aby sme priniesli novú a originálnu hudbu do osu!. Títo umelci a výber ich skladieb boli ručne vybrané osu! teamom vďaka tomu, že boli úžasné a vhodné pre mapovanie. Niektorí z týchto vybraných umelcov taktiež vytvorili exkluzívne skladby pre použitie v osu!.<br><br>Všetky skladby v tejto sekcii sú poskytnuté ako predom načasované .osz súbory a boli oficiálne licencované pre použitie v osu! a obsahu súvisiacom s osu!.',
    ],

    'links' => [
        'beatmaps' => 'osu! Beatmapy',
        'osu' => 'osu! profil',
        'site' => 'Oficiálna Webstránka',
    ],

    'songs' => [
        '_' => 'Skladby',
        'count' => ':count skladba|:count skladby',
        'original' => 'osu! originál',
        'original_badge' => 'ORIGINÁL',
    ],

    'tracklist' => [
        'title' => 'názov',
        'length' => 'dĺžka',
        'bpm' => 'bpm',
        'genre' => 'žáner',
    ],

    'tracks' => [
        'index' => [
            '_' => 'vyhľadávanie skladieb',

            'exclusive_only' => [
                'all' => 'Všetko',
                'exclusive_only' => '',
            ],

            'form' => [
                'advanced' => 'Rozšírené Vyhľadávanie',
                'album' => 'Album',
                'artist' => 'Umelec',
                'bpm_gte' => 'Minimálne BPM',
                'bpm_lte' => 'MaximálneBPM',
                'empty' => 'Nenašli sa žiadne skladby zodpovedajúce kritériám vyhľadávania.',
                'exclusive_only' => 'Typ',
                'genre' => 'Žáner',
                'genre_all' => 'Všetko',
                'length_gte' => 'Minimálna dĺžka',
                'length_lte' => 'Maximálna dĺžka',
            ],
        ],
    ],
];
