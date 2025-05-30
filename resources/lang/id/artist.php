<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Featured Artist di osu!',
    'title' => 'Featured Artist',

    'admin' => [
        'hidden' => 'ARTIS SAAT INI TERSEMBUNYI',
    ],

    'beatmaps' => [
        '_' => 'Beatmap',
        'download' => 'unduh template beatmap',
        'download-na' => 'template beatmap belum tersedia',
    ],

    'index' => [
        'description' => 'Featured Artist merupakan jajaran musisi yang berkolaborasi dengan kami untuk menghadirkan berbagai lagu baru dan orisinal ke osu!. Para musisi berikut, beserta dengan karya pilihan mereka, telah dipilih langsung oleh tim osu! atas dasar lagu-lagu mereka yang kece dan cocok untuk mapping. Lebih dari itu, sebagian dari Featured Artist ini bahkan juga telah menulis sejumlah lagu baru yang khusus dibuat untuk osu!.<br><br>Seluruh lagu pada halaman ini disediakan dalam bentuk berkas .osz dengan timing yang telah ditentukan sebelumnya (pre-timed) serta telah terlisensi secara resmi untuk dapat digunakan di osu! dan konten yang terkait dengan osu!.',
    ],

    'links' => [
        'beatmaps' => 'Daftar Beatmap',
        'osu' => 'Profil osu!',
        'site' => 'Situs Web Resmi',
    ],

    'songs' => [
        '_' => 'Lagu',
        'count' => ':count_delimited lagu|:count_delimited lagu',
        'original' => 'osu! original',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'judul',
        'length' => 'durasi',
        'bpm' => 'bpm',
        'genre' => 'aliran',
    ],

    'tracks' => [
        'index' => [
            '_' => 'pencarian lagu',

            'exclusive_only' => [
                'all' => 'Semua',
                'exclusive_only' => 'osu! original',
            ],

            'form' => [
                'advanced' => 'Pencarian Lanjutan',
                'album' => 'Album',
                'artist' => 'Artis',
                'bpm_gte' => 'BPM Minimal',
                'bpm_lte' => 'BPM Maksimal',
                'empty' => 'Tidak ada lagu yang sesuai dengan kriteria pencarian yang ditentukan.',
                'exclusive_only' => 'Jenis',
                'genre' => 'Aliran',
                'genre_all' => 'Semua',
                'length_gte' => 'Durasi Minimal',
                'length_lte' => 'Durasi Maksimal',
            ],
        ],
    ],
];
