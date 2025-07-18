<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Karena sesungguhnya persaingan tidak hanya terjadi di dalam permainan.',
        'large' => 'Kontes Komunitas',
    ],

    'index' => [
        'nav_title' => 'daftar',
    ],

    'judge' => [
        'comments' => 'komentar',
        'hide_judged' => 'sembunyikan entri yang telah dinilai',
        'nav_title' => 'juri',
        'no_current_vote' => 'kamu belum memberikan suaramu.',
        'update' => 'perbarui',
        'validation' => [
            'missing_score' => 'skor hilang',
            'contest_vote_judged' => 'kamu tidak dapat memberikan suara pada kontes yang dinilai oleh juri',
        ],
        'voted' => 'Kamu telah memberikan suara untuk entri ini.',
    ],

    'judge_results' => [
        '_' => 'Hasil penjurian',
        'creator' => 'pembuat',
        'score' => 'Skor',
        'score_std' => '',
        'total_score' => 'jumlah skor',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Kamu adalah juri pada kontes ini. Nilai entri yang masuk di sini!',
        'judged_notice' => 'Kontes ini menggunakan sistem penjurian, dan para juri saat ini sedang menilai entri yang masuk.',
        'login_required' => 'Silakan masuk untuk memberikan suara.',
        'over' => 'Pemungutan suara untuk kontes ini telah berakhir',
        'show_voted_only' => 'Tampilkan pilihan',

        'best_of' => [
            'none_played' => "Sepertinya kamu belum memainkan beatmap mana pun yang terdaftar pada kontes ini!",
        ],

        'button' => [
            'add' => 'Pilih',
            'remove' => 'Lepas pilihan',
            'used_up' => 'Kamu telah menggunakan seluruh hak suaramu',
        ],

        'progress' => [
            '_' => ':used / :max suara telah digunakan',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Seluruh beatmap yang terkandung pada playlist yang ditentukan harus terlebih dahulu dimainkan sebelum memberikan suara',
            ],
        ],
    ],

    'entry' => [
        '_' => 'entri',
        'login_required' => 'Silakan masuk untuk mengikuti kontes.',
        'silenced_or_restricted' => 'Kamu tidak dapat mengikuti kontes ketika kamu sedang di-restrict atau di-silence.',
        'preparation' => 'Kami sedang mempersiapkan kontes ini. Mohon bersabar!',
        'drop_here' => 'Letakkan entrimu di sini',
        'download' => 'Unduh .osz',

        'wrong_type' => [
            'art' => 'Kontes ini hanya menerima berkas dengan ekstensi .jpg dan .png.',
            'beatmap' => 'Kontes ini hanya menerima berkas dengan ekstensi .osu.',
            'music' => 'Kontes ini hanya menerima berkas dengan ekstensi .mp3.',
        ],

        'wrong_dimensions' => 'Entri untuk kontes ini harus berukuran :widthx:height',
        'too_big' => 'Berkas yang diikutsertakan untuk kontes ini tidak boleh melebihi batas ukuran :limit.',
    ],

    'beatmaps' => [
        'download' => 'Unduh Entri',
    ],

    'vote' => [
        'list' => 'suara',
        'count' => ':count_delimited suara|:count_delimited suara',
        'points' => ':count_delimited poin|:count_delimited poin',
        'points_float' => '',
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
        'voting' => 'Dalam Tahap Pemungutan Suara',
        'results' => 'Telah Berakhir',
    ],
];
