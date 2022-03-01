<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Paket-paket beatmap yang tersusun atas satu tema tertentu.',
        'nav_title' => 'daftar',
        'title' => 'Paket Beatmap',

        'blurb' => [
            'important' => 'BACA INI SEBELUM MENGUNDUH',
            'install_instruction' => 'Petunjuk Pemasangan: Setelah paket beatmap selesai diunduh, ekstrak berkas. rar yang Anda peroleh ke dalam folder Songs yang terdapat pada direktori osu! Anda.',
            'note' => [
                '_' => 'Kami menyarankan Anda untuk :scary karena pada umumnya beatmap-beatmap keluaran terdahulu memiliki kualitas yang jauh lebih rendah dibanding beatmap-beatmap modern.',
                'scary' => 'mengunduh paket beatmap mulai dari yang paling baru hingga yang paling awal',
            ],
        ],
    ],

    'show' => [
        'download' => 'Unduh',
        'item' => [
            'cleared' => 'telah dimainkan',
            'not_cleared' => 'belum dimainkan',
        ],
        'no_diff_reduction' => [
            '_' => 'Anda tidak dapat menggunakan :link untuk menuntaskan paket beatmap ini.',
            'link' => 'mod-mod pengurang kesulitan',
        ],
    ],

    'mode' => [
        'artist' => 'Artis/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standar',
        'theme' => 'Tematik',
    ],

    'require_login' => [
        '_' => 'Anda harus :link untuk dapat mengunduh',
        'link_text' => 'masuk',
    ],
];
