<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu! Featured artistit',
    'title' => 'Featured Artistit',

    'admin' => [
        'hidden' => 'ARTISTI ON TÄLLÄ HETKELLÄ PIILOTETTU',
    ],

    'beatmaps' => [
        '_' => 'Beatmapit',
        'download' => 'Lataa Beatmap-Pohja',
        'download-na' => 'rytmikarttapohja ei ole vielä saatavilla',
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

            'form' => [
                'advanced' => 'Laajennettu haku',
                'album' => 'Albumi',
                'artist' => 'Esittäjä',
                'bpm_gte' => 'BPM vähintään',
                'bpm_lte' => 'BPM enintään',
                'empty' => 'Hakukriteerejä vastaavia kappaleita ei löytynyt.',
                'genre' => 'Tyylilaji',
                'genre_all' => 'Kaikki',
                'length_gte' => 'Vähimmäispituus',
                'length_lte' => 'Enimmäispituus',
            ],
        ],
    ],
];
