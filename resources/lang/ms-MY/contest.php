<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Beradu bukan sekadar mengklik bulatan.',
        'large' => 'Peraduan Komuniti',
    ],

    'index' => [
        'nav_title' => 'senarai',
    ],

    'judge' => [
        'comments' => 'komen',
        'hide_judged' => 'sorok penyertaan yang telah dinilai',
        'nav_title' => 'penilai',
        'no_current_vote' => 'anda belum mengundi.',
        'update' => 'kemas kini',
        'validation' => [
            'missing_score' => 'markah tiada',
            'contest_vote_judged' => 'tidak boleh mengundi dalam peraduan berpenilai',
        ],
        'voted' => 'Anda telah menyerahkan undian untuk penyertaan ini.',
    ],

    'judge_results' => [
        '_' => 'Hasil penilaian',
        'creator' => 'pencipta',
        'score' => 'Markah',
        'score_std' => 'Markah Terpiawai',
        'total_score' => 'jumlah markah',
        'total_score_std' => 'jumlah markah terpiawai',
    ],

    'voting' => [
        'judge_link' => 'Anda penilai peraduan ini. Nilai penyertaan di sini!',
        'judged_notice' => 'Peraduan ini menggunakan tatanan penilaian. Penilai kini memproses penyertaan.',
        'login_required' => 'Sila daftar masuk untuk mengundi.',
        'over' => 'Pengundian untuk peraduan ini telah tamat',
        'show_voted_only' => 'Tunjukkan undian',

        'best_of' => [
            'none_played' => "Nampaknya anda belum bermain peta rentak yang layak untuk peraduan ini!",
        ],

        'button' => [
            'add' => 'Undi',
            'remove' => 'Padam undian',
            'used_up' => 'Anda telah menggunakan semua undian anda',
        ],

        'progress' => [
            '_' => ':used / :max undian diguna',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Main semua peta rentak dalam senarai main yang ditentukan sebelum mengundi',
            ],
        ],
    ],

    'entry' => [
        '_' => 'penyertaan',
        'login_required' => 'Sila daftar masuk untuk menyertai peraduan.',
        'silenced_or_restricted' => 'Anda tidak boleh menyertai peraduan ketika dihadkan atau didiamkan.',
        'preparation' => 'Kami kini menyiapkan peraduan ini. Mohon bersabar!',
        'drop_here' => 'Lepaskan penyertaan di sini',
        'download' => 'Muat turun .osz',

        'wrong_type' => [
            'art' => 'Hanya fail .jpg dan .png diterima untuk peraduan.',
            'beatmap' => 'Hanya fail .osu diterima untuk peraduan.',
            'music' => 'Hanya fail .mp3 diterima untuk peraduan.',
        ],

        'wrong_dimensions' => 'Penyertaan untuk peraduan mesti :widthx:height',
        'too_big' => 'Penyertaan peraduan ini hanya dibolehkan hingga :limit.',
    ],

    'beatmaps' => [
        'download' => 'Muat Turun Penyertaan',
    ],

    'vote' => [
        'list' => 'undian',
        'count' => ':count_delimited undian',
        'points' => ':count_delimited mata',
        'points_float' => ':points mata',
    ],

    'dates' => [
        'ended' => 'Tamat :date',
        'ended_no_date' => 'Tamat',

        'starts' => [
            '_' => 'Mula :date',
            'soon' => 'nanti™',
        ],
    ],

    'states' => [
        'entry' => 'Terbuka untuk Masukan',
        'voting' => 'Pengundian Bermula',
        'results' => 'Hasil Diumumkan',
    ],

    'show' => [
        'admin' => [
            'page' => 'Lihat maklumat dan masukan',
        ],
    ],
];
