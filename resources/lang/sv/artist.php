<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Utvalda artister på osu!',
    'title' => 'Utvalda artister',

    'admin' => [
        'hidden' => 'ARTISTEN ÄR FÖR NÄRVARANDE GÖMD',
    ],

    'beatmaps' => [
        '_' => 'Beatmaps',
        'download' => 'Ladda ner beatmapmall',
        'download-na' => 'Beatmapmallen är inte tillgänglig ännu',
    ],

    'index' => [
        'description' => 'Utvalda artister är artister som vi jobbar tillsammans med för att skapa ny och originell musik till osu!. Dessa artister och ett urval av deras låtar har blivit handplockade av osu! teamet på grund av att de är grymt bra och lämpliga för mapping. Några av dessa utvalda artister har också skapat exklusiva nya låtar för användning i osu! <br><br>Alla dessa låtar i denna sektion ges ut som för-tajmade .osz filer och har blivit officielt licensierade för använding i osu! och osu!-relaterat innehåll.',
    ],

    'links' => [
        'beatmaps' => 'osu!-beatmaps',
        'osu' => 'osu! profil',
        'site' => 'Officiell hemsida',
    ],

    'songs' => [
        '_' => 'Låtar',
        'count' => ':count låt|:count låtar',
        'original' => 'osu! original',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'titel',
        'length' => 'längd',
        'bpm' => 'bpm',
        'genre' => 'genre',
    ],

    'tracks' => [
        'index' => [
            '_' => 'spårsökning',

            'exclusive_only' => [
                'all' => 'Alla',
                'exclusive_only' => 'osu! original',
            ],

            'form' => [
                'advanced' => 'Avancerad sökning',
                'album' => 'Album',
                'artist' => 'Artist',
                'bpm_gte' => 'Minsta BPM',
                'bpm_lte' => 'Högsta BPM',
                'empty' => 'Inga spår som matchade sökfiltret hittades.',
                'exclusive_only' => 'Typ',
                'genre' => 'Genre',
                'genre_all' => 'Alla',
                'length_gte' => 'Minsta längd',
                'length_lte' => 'Högsta längd',
            ],
        ],
    ],
];
