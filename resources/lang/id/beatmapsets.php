<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'parts-removed' => 'Beberapa bagian dari beatmap ini telah dihapus atas permintaan pembuat lagu atau pemegang hak pihak ketiga.',
        'more-info' => 'Lihat di sini untuk informasi lebih lanjut.',
    ],

    'index' => [
        'title' => 'Daftar Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'show' => [
        'discussion' => 'Diskusi',

        'details' => [
            'made-by' => 'dibuat oleh ',
            'submitted' => 'diunggah pada ',
            'updated' => 'terakhir diperbarui pada ',
            'ranked' => 'ranked pada ',
            'approved' => 'approved pada ',
            'qualified' => 'qualified pada ',
            'loved' => 'loved pada ',
            'logged-out' => 'Anda harus masuk sebelum mengunduh beatmap!',
            'download' => [
                '_' => 'Unduh',
                'video' => 'dengan Video',
                'no-video' => 'tanpa Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favoritkan beatmapset ini',
            'unfavourite' => 'Batal Favoritkan beatmapset ini',
            'favourited_count' => '+ 1 lagi!|+ :count lagi!',
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
            'rating-spread' => 'Nilai Spread',
            'nominations' => 'Nominasi',
            'playcount' => 'Jumlah Dimainkan',
        ],
        'info' => [
            'description' => 'Deskripsi',
            'genre' => 'Aliran',
            'language' => 'Bahasa',
            'no_scores' => 'Data sedang diproses...',
            'points-of-failure' => 'Titik Kegagalan',
            'source' => 'Sumber',
            'success-rate' => 'Tingkat Keberhasilan',
            'tags' => 'Tag',
            'unranked' => 'Beatmap non-ranked',
        ],
        'scoreboard' => [
            'achieved' => 'dicapai pada :when',
            'country' => 'Peringkat Negara',
            'friend' => 'Peringkat Teman',
            'global' => 'Peringkat Global',
            'supporter-link' => 'Klik <a href=":link">di sini</a> untuk melihat semua fitur eksklusif yang anda dapatkan!',
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
                'country' => 'Tidak seorang pun dari negara anda yang memiliki skor di map ini!',
                'friend' => 'Tidak seorang pun dari daftar teman anda yang memiliki skor di map ini!',
                'global' => 'Belum ada skor yang dicetak. Mungkin anda harus coba mencetak satu?',
                'loading' => 'Memuat skor...',
                'unranked' => 'Beatmap non-ranked.',
            ],
            'score' => [
                'first' => 'Di Posisi Pertama',
                'own' => 'Rekor Anda',
            ],
        ],
    ],
];
