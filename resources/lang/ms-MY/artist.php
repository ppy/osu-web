<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => '\'Featured Artists\' di osu!',
    'title' => 'Featured Artists',

    'admin' => [
        'hidden' => 'ARTIS INI TERSEMBUNYI',
    ],

    'beatmaps' => [
        '_' => 'Beatmaps',
        'download' => 'muat turun templat beatmap',
        'download-na' => 'templat beatmap belum lagi tersedia',
    ],

    'index' => [
        'description' => 'Featured Artist merupakan artis-artis yang telah secara rasmi bekerjasama dengan kami dalam menyediakan lagu-lagu baru dan asli untuk osu!. Para artis berikut — beserta karya-karya pilihan mereka — telah dipilih secara saksama oleh kumpulan kami bagi para mapper untuk dapat berkreasi dengannya. Lebih dari itu, beberapa dari mereka bahkan telah turut menciptakan lagu-lagu baru untuk osu! secara eksklusif.<br><br>Seluruh lagu yang tertera pada katalog di bawah ini dapat dimuat turun secara bebas dalam format .osz (lengkap dengan penetapan masa yang telah kami siapkan sebelumnya) serta telah diizinkan secara sah untuk dapat dipergunakan dan disebarluaskan di dalam osu! dan kandungan berkaitan osu!.',
    ],

    'links' => [
        'beatmaps' => 'Daftar Beatmap',
        'osu' => 'Profil osu!',
        'site' => 'Laman Web Rasmi',
    ],

    'songs' => [
        '_' => 'Lagu',
        'count' => ':count_delimited lagu|:count_delimited lagu',
        'original' => 'osu! original',
        'original_badge' => 'ASLI',
    ],

    'tracklist' => [
        'title' => 'tajuk',
        'length' => 'tempoh',
        'bpm' => 'bpm',
        'genre' => 'genre',
    ],

    'tracks' => [
        'index' => [
            '_' => 'carian lagu',

            'exclusive_only' => [
                'all' => 'Semua',
                'exclusive_only' => 'osu! original',
            ],

            'form' => [
                'advanced' => 'Carian Lanjut',
                'album' => 'Album',
                'artist' => 'Artis',
                'bpm_gte' => 'BPM Minimum',
                'bpm_lte' => 'BPM Maksimum',
                'empty' => 'Tiada lagu yang sesuai dengan ukur tara pencarian yang ditentukan.',
                'exclusive_only' => 'Jenis',
                'genre' => 'Genre',
                'genre_all' => 'Semua',
                'length_gte' => 'Tempoh Minimum',
                'length_lte' => 'Tempoh Maksimum',
            ],
        ],
    ],
];
