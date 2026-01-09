<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu! Rekomenduojami atlikėjai',
    'title' => 'Ryškieji Atlikėjai',

    'admin' => [
        'hidden' => 'ŠIS ATLIKĖJAS ŠIUO METU YRA PASLĖPTAS',
    ],

    'beatmaps' => [
        '_' => 'Beatmap\'ai',
        'download' => 'atsisiųsti beatmap\'o šabloną',
        'download-na' => 'beatmap\'o šablonas dar nepasiekiamas',
    ],

    'index' => [
        'description' => 'Ryškieji atlikėjai - tai atlikėjai su kuriais mes bendradarbiaujame norint suteikti naujausią ir orginaliausią muziką osu! žaidime. Šie atlikėjai ir jų išskirtiniai kūriniai buvo išrinkti osu! komandos kaip geriausi ir labiausiai tinkami beatmap\'ų kūrimui. Kai kurie atlikėjai sukūrė specialiai osu! skirtų kūrinių.<br><br>Visi kūriniai šioje skiltyje yra pateikti jau su sureguliuotu tempu ir buvo oficialiai licencijuoti naudojimui osu! žaidime ir su osu! žaidimu susijusiam turiniui.',
    ],

    'links' => [
        'beatmaps' => 'osu! Beatmap\'ai',
        'osu' => 'osu! profilis',
        'site' => 'Oficialus Tinklalapis',
    ],

    'songs' => [
        '_' => 'Dainos',
        'count' => ':count daina |:count dainos',
        'original' => 'osu! autentiškas',
        'original_badge' => 'Autentiškas',
    ],

    'tracklist' => [
        'title' => 'pavadinimas',
        'length' => 'trukmė',
        'bpm' => 'bpm',
        'genre' => 'žanras',
    ],

    'tracks' => [
        'index' => [
            '_' => 'takelių paieška',

            'exclusive_only' => [
                'all' => 'Visi',
                'exclusive_only' => 'osu! autentiški',
            ],

            'form' => [
                'advanced' => 'Išplėstinė paieška',
                'album' => 'Albumas',
                'artist' => 'Atlikėjas',
                'bpm_gte' => 'Minimalus BPM',
                'bpm_lte' => 'Maksimalus BPM',
                'empty' => 'Takelių atitinkančių paieškos kriterijus nerasta.',
                'exclusive_only' => 'Tipas',
                'genre' => 'Žanras',
                'genre_all' => 'Visi',
                'length_gte' => 'Minimali Trukmė',
                'length_lte' => 'Maksimali Trukmė',
            ],
        ],
    ],
];
