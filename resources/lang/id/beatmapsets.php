<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Beatmap saat ini tidak tersedia untuk diunduh.',
        'parts-removed' => 'Beberapa bagian dari beatmap ini telah dihapus atas permintaan pembuat lagu atau pihak ketiga pemegang hak cipta.',
        'more-info' => 'Lihat di sini untuk informasi lebih lanjut.',
    ],

    'index' => [
        'title' => 'Daftar Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'panel' => [
        'download' => [
            'all' => 'unduh',
            'video' => 'unduh dengan video',
            'no_video' => 'unduh tanpa video',
            'direct' => 'buka melalui osu!direct',
        ],
    ],

    'show' => [
        'discussion' => 'Diskusi',

        'details' => [
            'favourite' => 'Masukkan beatmapset ini ke dalam daftar Favorit Anda',
            'logged-out' => 'Anda harus masuk sebelum mengunduh beatmap!',
            'mapped_by' => 'dibuat oleh :mapper',
            'unfavourite' => 'Hapus beatmapset ini dari daftar Favorit Anda',
            'updated_timeago' => 'terakhir diperbarui :timeago',

            'download' => [
                '_' => 'Unduh',
                'direct' => 'osu!direct',
                'no-video' => 'tanpa Video',
                'video' => 'dengan Video',
            ],

            'login_required' => [
                'bottom' => 'untuk mengakses lebih banyak fitur',
                'top' => 'Masuk',
            ],
        ],

        'details_date' => [
            'approved' => 'berstatus Approved sejak :timeago',
            'loved' => 'berstatus Loved sejak :timeago',
            'qualified' => 'berstatus Qualified sejak :timeago',
            'ranked' => 'berstatus Ranked sejak :timeago',
            'submitted' => 'diunggah pada :timeago',
            'updated' => 'terakhir diperbarui :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Beatmap yang telah Anda favorit terlalu banyak! Mohon hapus beberapa sebelum melanjutkan.',
        ],

        'hype' => [
            'action' => 'Apabila Anda menyukai beatmap ini, berikanlah hype Anda untuk mendorong beatmap ini agar dapat selangkah lebih dekat menuju status <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Map ini sedang berstatus :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'dalam pengerjaan (work-in-progress)',
                ],
            ],

            'disqualify' => [
                '_' => 'Jika Anda menemukan masalah pada beatmap ini, mohon diskualifikasi beatmap yang bersangkutan melalui :link.',
            ],

            'report' => [
                '_' => 'Jika Anda menemukan masalah pada beatmap ini, mohon laporkan kepada tim kami melalui :link.',
                'button' => 'Laporkan Masalah',
                'link' => 'tautan ini',
            ],
        ],

        'info' => [
            'description' => 'Deskripsi',
            'genre' => 'Aliran',
            'language' => 'Bahasa',
            'no_scores' => 'Data sedang diproses...',
            'points-of-failure' => 'Titik-Titik Kegagalan',
            'source' => 'Sumber',
            'success-rate' => 'Tingkat Keberhasilan',
            'tags' => 'Tag',
        ],

        'scoreboard' => [
            'achieved' => 'dicapai pada :when',
            'country' => 'Peringkat Negara',
            'friend' => 'Peringkat Teman',
            'global' => 'Peringkat Global',
            'supporter-link' => 'Klik <a href=":link">di sini</a> untuk melihat semua fitur eksklusif yang Anda dapatkan!',
            'supporter-only' => 'Anda harus menjadi supporter untuk mengakses fitur peringkat teman dan negara!',
            'title' => 'Papan Skor',

            'headers' => [
                'accuracy' => 'Akurasi',
                'combo' => 'Kombo Maks',
                'miss' => 'Miss',
                'mods' => 'Mod',
                'player' => 'Pemain',
                'pp' => 'pp',
                'rank' => 'Peringkat',
                'score_total' => 'Jumlah Skor',
                'score' => 'Skor',
                'time' => 'Waktu',
            ],

            'no_scores' => [
                'country' => 'Tidak seorang pun dari negara Anda yang memiliki skor di map ini!',
                'friend' => 'Tidak seorang pun dari daftar teman Anda yang memiliki skor di map ini!',
                'global' => 'Belum ada skor yang tercatat pada beatmap ini. Mungkin Anda tertarik untuk mencetak skor Anda sendiri?',
                'loading' => 'Memuat skor...',
                'unranked' => 'Beatmap ini tidak berstatus Ranked.',
            ],
            'score' => [
                'first' => 'Di Posisi Pertama',
                'own' => 'Skor Terbaik Anda',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Key Amount',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Durasi',
            'bpm' => 'BPM',
            'count_circles' => 'Jumlah Circle',
            'count_sliders' => 'Jumlah Slider',
            'user-rating' => 'Nilai Pengguna',
            'rating-spread' => 'Persebaran Nilai Pengguna',
            'nominations' => 'Nominasi',
            'playcount' => 'Jumlah Dimainkan',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],
];
