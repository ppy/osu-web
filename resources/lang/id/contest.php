<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Karena sesungguhnya persaingan tidak hanya terjadi di dalam lapangan permainan.',
        'large' => 'Kontes Komunitas',
    ],

    'index' => [
        'nav_title' => 'daftar',
    ],

    'voting' => [
        'login_required' => 'Silakan masuk untuk memberikan suara.',
        'over' => 'Pemungutan suara untuk kontes ini telah berakhir',
        'show_voted_only' => 'Tampilkan pilihan',

        'best_of' => [
            'none_played' => "Sepertinya Anda belum pernah memainkan beatmap manapun yang terdaftar pada kontes ini!",
        ],

        'button' => [
            'add' => 'Pilih',
            'remove' => 'Hapus pilihan',
            'used_up' => 'Anda telah mempergunakan seluruh hak suara yang Anda miliki',
        ],

        'progress' => [
            '_' => ':used / :max suara telah dipergunakan',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Anda harus terlebih dahulu memainkan seluruh beatmap yang terdapat pada playlist untuk dapat memberikan suara',
            ],
        ],
    ],
    'entry' => [
        '_' => 'entri',
        'login_required' => 'Silakan masuk untuk mengikuti kontes.',
        'silenced_or_restricted' => 'Anda tidak dapat mengikuti kontes ketika akun Anda sedang di-restrict atau di-silence.',
        'preparation' => 'Kami sedang mempersiapkan kontes ini. Harap bersabar!',
        'drop_here' => 'Letakkan entri Anda di sini',
        'download' => 'Unduh .osz',
        'wrong_type' => [
            'art' => 'Kontes ini hanya menerima berkas dengan ekstensi .jpg dan .png.',
            'beatmap' => 'Kontes ini hanya menerima berkas dengan ekstensi .osu.',
            'music' => 'Kontes ini hanya menerima berkas dengan ekstensi .mp3.',
        ],
        'too_big' => 'Berkas yang diikutsertakan untuk kontes ini tidak boleh melebihi batas ukuran :limit.',
    ],
    'beatmaps' => [
        'download' => 'Unduh Entri',
    ],
    'vote' => [
        'list' => 'suara',
        'count' => ':count_delimited suara|:count_delimited suara',
        'points' => ':count_delimited poin|:count_delimited poin',
    ],
    'dates' => [
        'ended' => 'Telah Berakhir Pada :date',
        'ended_no_date' => 'Telah Berakhir',

        'starts' => [
            '_' => 'Akan Dimulai Pada :date',
            'soon' => 'segera™',
        ],
    ],
    'states' => [
        'entry' => 'Menerima Entri',
        'voting' => 'Dalam Tahapan Pemungutan Suara',
        'results' => 'Telah Berakhir',
    ],
];
