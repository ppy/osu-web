<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

        'favourites' => [
            'limit_reached' => 'Beatmap yang telah Anda favorit terlalu banyak! Mohon hapus beberapa sebelum melanjutkan.',
        ],

        'hype' => [
            'action' => 'Apabila Anda menyukai beatmap ini, berikanlah hype Anda untuk mendorong beatmap ini selangkah lebih dekat menuju status <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Map ini sedang berstatus :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'dalam pengerjaan',
                ],
            ],

            'disqualify' => [
                '_' => 'Jika kamu menemukan masalah dengan beatmap ini, mohon diskualifikasi melewati :link.',
                'button_title' => 'Diskualifikasi beatmap yang sudah qualified.',
            ],

            'report' => [
                '_' => 'Jika kamu menemukan masalah di beatmap ini, mohon laporkan kepada tim melewati tautan :link berikut.',
                'button' => 'Lapokan Masalah',
                'button_title' => 'Laporkan permasalahan yang ada di beatmap yang sudah qualified.',
                'link' => 'disini',
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
            'unranked' => 'Beatmap ini tidak berstatus Ranked.',
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
                'mods' => 'Mods',
                'player' => 'Pengguna',
                'pp' => 'pp',
                'rank' => 'Peringkat',
                'score_total' => 'Jumlah Skor',
                'score' => 'Skor',
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
                'own' => 'Rekor Anda',
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
