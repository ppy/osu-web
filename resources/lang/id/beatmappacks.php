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
            'install_instruction' => '',
            'note' => [
                '_' => 'Di samping itu, Anda juga sangat disarankan untuk :scary mengingat pada umumnya map-map keluaran terdahulu memiliki kualitas yang jauh lebih rendah dibanding map-map keluaran terbaru.',
                'scary' => 'mengunduh paket dari yang terbaru ke yang paling lama',
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
            '_' => 'Anda tidak boleh menggunakan :link untuk dapat membuka medali yang terhubung dengan paket beatmap ini.',
            'link' => 'mod-mod yang mempermudah permainan (EZ, NF, atau HT)',
        ],
    ],

    'mode' => [
        'artist' => 'Artis/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standar',
        'theme' => 'Tematik',
    ],

    'require_login' => [
        '_' => 'Anda harus :link untuk mengunduh',
        'link_text' => 'masuk',
    ],
];
