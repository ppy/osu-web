<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Kiemelt előadók osu!-ban',
    'title' => 'Kiemelt Előadók',

    'admin' => [
        'hidden' => 'AZ ELŐADÓ JELENLEG EL VAN REJTVE',
    ],

    'beatmaps' => [
        '_' => 'Beatmap-ek',
        'download' => 'Beatmap Minta Letöltés',
        'download-na' => 'Beatmap Minta még nem elérhető',
    ],

    'index' => [
        'description' => 'A kiemelt előadók olyan emberek, akikkel együtt dolgozunk annak érdekében, hogy új és eredeti zenéket hozzunk az osu!-ba. Ezek az előadók és jó-pár zeneszámuk kézzel lettek válogatva az osu! csapat által, mivel nagyon fantasztikusak és megfelelőek beatmap-készítésre. Páran, ezen kiemelt előadók közül már készítettek osu!-exkluzív zeneszámokat is.<br><br>Ebben a részben minden szám egy előre időzített .osz fájlként állnak rendelkezésre és hivatalosan licenc-szeltek az osu!-ban és az osu!-val kapcsolatos tartalmak használatára.',
    ],

    'links' => [
        'beatmaps' => 'osu! beatmapek',
        'osu' => 'osu! profil',
        'site' => 'Hivatalos Weboldal',
    ],

    'songs' => [
        '_' => 'Zenék',
        'count' => ':count szám|:count szám',
        'original' => 'osu! eredeti',
        'original_badge' => 'EREDETI',
    ],

    'tracklist' => [
        'title' => 'cím',
        'length' => 'hossz',
        'bpm' => 'bpm',
        'genre' => 'műfaj',
    ],

    'tracks' => [
        'index' => [
            '_' => 'zeneszám keresés',

            'form' => [
                'advanced' => 'Részletes keresés',
                'album' => 'Album',
                'artist' => 'Előadó',
                'bpm_gte' => 'Minimum BPM',
                'bpm_lte' => 'Maximum BPM',
                'empty' => 'Nem található a keresési feltételeknek megfelelő zeneszám.',
                'genre' => 'Műfaj',
                'genre_all' => 'Mind',
                'length_gte' => 'Minimum hossz',
                'length_lte' => 'Maximum hossz',
            ],
        ],
    ],
];
