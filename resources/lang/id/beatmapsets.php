<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Beatmap saat ini tidak tersedia untuk diunduh.',
        'parts-removed' => 'Beberapa bagian dari beatmap ini telah dihapus atas permintaan pembuatnya atau pihak ketiga pemegang hak cipta.',
        'more-info' => 'Lihat di sini untuk informasi lebih lanjut.',
        'rule_violation' => 'Sebagian aset yang terkandung dalam beatmap ini telah dihapus setelah dinilai tidak layak untuk digunakan di osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap yang telah dihapus',
    ],

    'download' => [
        'limit_exceeded' => 'Jangan terlalu bernafsu dalam mengunduh. Mainkan beatmap yang telah kamu miliki terlebih dahulu.',
        'no_mirrors' => 'Tidak ada server unduhan yang tersedia.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured Artist',
    ],

    'index' => [
        'title' => 'Daftar Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'panel' => [
        'empty' => 'tidak ada beatmap',

        'download' => [
            'all' => 'unduh',
            'video' => 'unduh dengan video',
            'no_video' => 'unduh tanpa video',
            'direct' => 'buka di osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Nominator masa percobaan tidak dapat menominasikan lebih dari satu ruleset.',
        'full_nomination_required' => 'Kamu harus menjadi nominator penuh untuk memberikan nominasi terakhir pada suatu ruleset.',
        'hybrid_requires_modes' => 'Pada beatmap hybrid, kamu harus memilih setidaknya satu mode permainan untuk dinominasikan.',
        'incorrect_mode' => 'Kamu tidak memiliki izin untuk memberikan nominasi pada mode permainan: :mode',
        'invalid_limited_nomination' => 'Beatmap ini memiliki nominasi yang tidak valid dan tidak dapat dikualifikasikan dalam kondisi saat ini.',
        'invalid_ruleset' => 'Nominasi ini memiliki ruleset yang tidak valid.',
        'too_many' => 'Persyaratan nominasi telah terpenuhi.',
        'too_many_non_main_ruleset' => 'Persyaratan nominasi untuk ruleset yang bukan ruleset utama telah terpenuhi.',

        'dialog' => [
            'confirmation' => 'Apakah kamu yakin untuk menominasikan beatmap ini?',
            'different_nominator_warning' => 'Mengkualifikasikan beatmap ini dengan nominator yang berbeda akan mengatur ulang posisi antrean kualifikasinya.',
            'header' => 'Nominasikan Beatmap',
            'hybrid_warning' => 'catatan: kamu hanya dapat memberikan nominasi satu kali, sehingga pastikan kamu memberikan nominasi pada mode permainan yang memang kamu kehendaki',
            'current_main_ruleset' => 'Ruleset utama saat ini: :ruleset',
            'which_modes' => 'Mode permainan mana yang ingin dinominasikan?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplisit',
    ],

    'show' => [
        'discussion' => 'Diskusi',

        'admin' => [
            'full_size_cover' => 'Lihat gambar sampul ukuran penuh',
            'page' => 'Lihat halaman admin',
        ],

        'deleted_banner' => [
            'title' => 'Beatmap ini telah dihapus.',
            'message' => '(hanya moderator yang dapat melihat pesan ini)',
        ],

        'details' => [
            'by_artist' => 'oleh :artist',
            'favourite' => 'favoritkan beatmap ini',
            'favourite_login' => 'silakan masuk untuk memfavoritkan beatmap ini',
            'logged-out' => 'kamu harus masuk untuk mengunduh beatmap!',
            'mapped_by' => 'dibuat oleh :mapper',
            'mapped_by_guest' => 'tingkat kesulitan tamu oleh :mapper',
            'unfavourite' => 'hapus beatmap ini dari daftar favorit',
            'updated_timeago' => 'terakhir diperbarui :timeago',

            'download' => [
                '_' => 'Unduh',
                'direct' => '',
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
            'limit_reached' => 'Kamu telah memiliki terlalu banyak beatmap yang difavoritkan! Silakan hapus beberapa beatmap dari daftar favoritmu sebelum melanjutkan.',
        ],

        'hype' => [
            'action' => 'Apabila kamu menyukai beatmap ini, berikanlah hype-mu agar beatmap ini dapat selangkah lebih dekat menuju status <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Beatmap ini sedang berstatus :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'dalam pengerjaan (work-in-progress)',
                ],
            ],

            'disqualify' => [
                '_' => 'Apabila kamu menemukan suatu masalah pada beatmap ini, mohon diskualifikasi beatmap yang bersangkutan melalui :link.',
            ],

            'report' => [
                '_' => 'Apabila kamu menemukan suatu masalah pada beatmap ini, mohon laporkan kepada tim kami melalui :link.',
                'button' => 'Laporkan Masalah',
                'link' => 'tautan ini',
            ],
        ],

        'info' => [
            'description' => 'Deskripsi',
            'genre' => 'Aliran',
            'language' => 'Bahasa',
            'mapper_tags' => 'Tag Mapper',
            'no_scores' => 'Data sedang diproses...',
            'nominators' => 'Nominator',
            'nsfw' => 'Konten eksplisit',
            'offset' => 'Offset online',
            'pack_tags' => '',
            'points-of-failure' => 'Titik-Titik Kegagalan',
            'source' => 'Sumber',
            'storyboard' => 'Beatmap ini menyertakan storyboard',
            'success-rate' => 'Tingkat Keberhasilan',
            'success_rate_plays' => '',
            'user_tags' => 'Tag Pengguna',
            'video' => 'Beatmap ini menyertakan video',
        ],

        'nsfw_warning' => [
            'details' => 'Beatmap ini mengandung konten yang bersifat eksplisit, menyinggung, atau meresahkan. Apakah kamu tetap ingin menampilkan beatmap ini?',
            'title' => 'Konten Eksplisit',

            'buttons' => [
                'disable' => 'Nonaktifkan peringatan',
                'listing' => 'Daftar beatmap',
                'show' => 'Tampilkan',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'diraih pada :when',
            'country' => 'Peringkat Negara',
            'error' => 'Peringkat gagal dimuat',
            'friend' => 'Peringkat Teman',
            'global' => 'Peringkat Global',
            'supporter-link' => 'Klik <a href=":link">di sini</a> untuk melihat seluruh fitur menarik yang akan kamu peroleh!',
            'supporter-only' => 'Kamu harus menjadi osu!supporter untuk mengakses papan peringkat teman, negara, atau mod!',
            'team' => 'Peringkat Tim',
            'title' => 'Papan Skor',

            'headers' => [
                'accuracy' => 'Akurasi',
                'combo' => 'Kombo Maks',
                'miss' => 'Miss',
                'mods' => 'Mod',
                'pin' => 'Sematkan',
                'player' => 'Pemain',
                'pp' => '',
                'rank' => 'Peringkat',
                'score' => 'Skor',
                'score_total' => 'Jumlah Skor',
                'time' => 'Waktu',
            ],

            'no_scores' => [
                'country' => 'Belum ada seorang pun dari negaramu yang telah mencetak skor pada map ini!',
                'friend' => 'Belum ada seorang pun dari daftar temanmu yang telah mencetak skor pada map ini!',
                'global' => 'Belum ada skor yang tercatat. Mungkin kamu tertarik untuk mencetak skormu sendiri?',
                'loading' => 'Memuat skor...',
                'team' => 'Belum ada seorang pun dari tim kamu yang telah mencetak skor pada map ini!',
                'unranked' => 'Beatmap ini tidak berstatus Ranked.',
            ],
            'score' => [
                'first' => 'Di Posisi Pertama',
                'own' => 'Skor Terbaikmu',
            ],
            'supporter_link' => [
                '_' => 'Klik :here untuk melihat seluruh fitur menarik yang akan kamu peroleh!',
                'here' => 'di sini',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Jumlah Key',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Durasi Total (Durasi Bersih: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Jumlah Circle',
            'count_sliders' => 'Jumlah Slider',
            'offset' => 'Offset online: :offset',
            'user-rating' => 'Nilai Pengguna',
            'rating-spread' => 'Persebaran Nilai Pengguna',
            'nominations' => 'Nominasi',
            'playcount' => 'Jumlah Dimainkan',
            'favourites' => 'Favorit',
            'no_favourites' => 'Belum ada favorit',
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

    'spotlight_badge' => [
        'label' => 'Spotlight',
    ],
];
