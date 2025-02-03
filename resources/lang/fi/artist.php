<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu! Featured artistit',
    'title' => 'Esitellyt artistit',

    'admin' => [
        'hidden' => 'ARTISTI ON TÄLLÄ HETKELLÄ PIILOTETTU',
    ],

    'beatmaps' => [
        '_' => 'Beatmapit',
        'download' => 'Lataa rytmikarttapohja',
        'download-na' => 'rytmikarttapohja ei vielä saatavilla',
    ],

    'index' => [
        'description' => 'Featured artistit ovat artisteja, jotka toimivat kanssamme yhteistyössä tuoden peliin uutta ja alkuperäistä musiikkia. osu!-tiimi on varta vasten valinnut nämä artistit ja valikoiman heidän kappaleitaan soveltuvaksi beatmappien tekemiseen. Jotkut näistä artisteista ovat myös luoneet kappaleita yksinomaan käyttöön osu!:ssa.<br><br>Kaikki kappaleet tässä osiossa tarjotaan valmiiksi ajoitettuina .osz tiedostoina ja ovat virallisesti lisensoitu käytettäväksi pelissä ja siihen liittyvässä sisällössä.',
    ],

    'links' => [
        'beatmaps' => 'osu!-rytmikartat',
        'osu' => 'osu!-profiili',
        'site' => 'Virallinen verkkosivusto',
    ],

    'songs' => [
        '_' => 'Kappaleet',
        'count' => ':count_delimited kappale|:count_delimited kappaletta',
        'original' => 'osu!-alkuperäinen',
        'original_badge' => 'ALKUPERÄINEN',
    ],

    'tracklist' => [
        'title' => 'nimi',
        'length' => 'pituus',
        'bpm' => 'bpm',
        'genre' => 'tyylilaji',
    ],

    'tracks' => [
        'index' => [
            '_' => 'kappalehaku',

            'exclusive_only' => [
                'all' => 'Kaikki',
                'exclusive_only' => 'osu!-alkuperäinen',
            ],

            'form' => [
                'advanced' => 'Laajennettu haku',
                'album' => 'Albumi',
                'artist' => 'Artisti',
                'bpm_gte' => 'BPM Minimi',
                'bpm_lte' => 'BPM Maksimi',
                'empty' => 'Hakukriteerejä vastaavia kappaleita ei löytynyt.',
                'exclusive_only' => 'Tyyppi',
                'genre' => 'Tyylilaji',
                'genre_all' => 'Kaikki',
                'length_gte' => 'Vähimmäispituus',
                'length_lte' => 'Enimmäispituus',
            ],
        ],
    ],
];
