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
    'deleted' => '[pengguna yang dihapus]',

    'beatmapset_activities' => [
        'title' => 'Riwayat Modding :user',

        'discussions' => [
            'title_recent' => 'Diskusi terbaru yang baru dimulai',
        ],

        'events' => [
            'title_recent' => 'Peristiwa terbaru',
        ],

        'posts' => [
            'title_recent' => 'Postingan terbaru',
        ],

        'votes_received' => [
            'title_most' => 'Paling banyak divote oleh (3 bulan terakhir)',
        ],

        'votes_made' => [
            'title_most' => 'Paling banyak divote (3 bulan terakhir)',
        ],
    ],

    'card' => [
        'loading' => 'Memuat...',
        'send_message' => 'kirim pesan',
    ],

    'login' => [
        '_' => 'Masuk',
        'locked_ip' => 'Alamat IP anda dikunci. Mohon tunggu beberapa menit.',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Sandi',
        'button' => 'Masuk',
        'button_posting' => 'Mencoba masuk...',
        'remember' => 'Ingat perangkat ini',
        'title' => 'Mohon masuk untuk melanjutkan',
        'failed' => 'Gagal masuk',
        'register' => 'Belum memiliki akun osu!? Buat sekarang',
        'forgot' => 'Lupa kata sandi?',
        'beta' => [
            'main' => 'Akses beta saat ini dibatasi untuk pengguna istimewa.',
            'small' => '(Supporter akan segera masuk)',
        ],

        'here' => 'di sini', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Postingan :username',
    ],

    'signup' => [
        '_' => 'Daftar',
    ],
    'anonymous' => [
        'login_link' => 'klik untuk masuk',
        'login_text' => 'masuk',
        'username' => 'Tamu',
        'error' => 'Anda perlu masuk untuk melakukan ini.',
    ],
    'logout_confirm' => 'Apa anda yakin akan keluar? :(',
    'restricted_banner' => [
        'title' => 'Akun anda telah dibatasi!',
        'message' => 'Selama dibatasi, anda tidak dapat berinteraksi dengan pengguna lain dan skor hanya akan terlihat oleh anda. Hal ini biasanya terproses secara otomatis dan akan diangkat dalam 24 jam. Jika anda ingin mengajukan banding atas pembatasan anda, mohon<a href="mailto:accounts@ppy.sh">hubungi layanan dukungan</a>.',
    ],
    'show' => [
        'age' => ':age tahun',
        'change_avatar' => 'ganti avatar anda!',
        'first_members' => 'Di sini dari awal',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Bergabung :date',
        'lastvisit' => 'Terakhir terlihat :date',
        'missingtext' => 'Mungkin anda salah ketik! (atau pengguna mungkin telah diblokir)',
        'origin_age' => ':age',
        'origin_country_age' => ':age dari :country',
        'origin_country' => 'Dari :country',
        'page_description' => 'osu! - Segala sesuatu yang ingin anda ketahui tentang :username!',
        'previous_usernames' => 'dulu dikenal sebagai',
        'plays_with' => 'Bermain menggunakan :devices',
        'title' => 'profil :username',

        'edit' => [
            'cover' => [
                'button' => 'Ganti Sampul Profil',
                'defaults_info' => 'Pilihan sampul lainnya akan tersedia di masa mendatang',
                'upload' => [
                    'broken_file' => 'Gagal memproses gambar. Verifikasi gambar yang diunggah dan coba lagi.',
                    'button' => 'Unggah gambar',
                    'dropzone' => 'Letakkan di sini untuk mengunggah',
                    'dropzone_info' => 'Anda juga dapat meletakkan gambar anda di sini untuk mengunggah.',
                    'restriction_info' => "Unggah hanya tersedia untuk <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a>",
                    'size_info' => 'Ukuran sampul seharusnya 2000x700',
                    'too_large' => 'File yang diunggah terlalu besar.',
                    'unsupported_format' => 'Format tidak didukung.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode permainan default',
                'set' => 'Atur :mode sebagai mode permainan default profil',
            ],
        ],

        'extra' => [
            'followers' => '1 pengikut|:count pengikut',
            'unranked' => 'Tidak ada permainan akhir-akhir ini',

            'achievements' => [
                'title' => 'Pencapaian',
                'achieved-on' => 'Dicapai pada :date',
            ],
            'beatmaps' => [
                'none' => 'Saat ini tidak ada...',
                'title' => 'Beatmap',

                'favourite' => [
                    'title' => 'Beatmap Favorit (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmap Graveyarded (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Ranked & Approved (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmap Pending (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Tidak ada catatan performa. :(',
                'title' => 'Historis',

                'monthly_playcounts' => [
                    'title' => 'Riwayat Main',
                ],
                'most_played' => [
                    'count' => 'kali dimainkan',
                    'title' => 'Beatmap yang Paling Banyak Dimainkan',
                ],
                'recent_plays' => [
                    'accuracy' => 'akurasi: :percentage',
                    'title' => 'Permainan Terbaru (24j)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Riwayat Tayangan Ulang yang Ditonton',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Tersedia',
                'available_info' => 'Kudosu dapat ditukarkan menjadi kudosu stars, yang akan membantu beatmap anda mendapatkan lebih banyak perhatian. Berikut jumlah kudosu yang belum anda tukarkan.',
                'recent_entries' => 'Riwayat Kudosu Terbaru',
                'title' => 'Kudosu!',
                'total' => 'Jumlah Kudosu yang diperoleh',
                'total_info' => 'Berdasarkan seberapa banyak kontribusi yang telah dilakukan pengguna terhadap modding beatmap. Lihat <a href="'.osu_url('user.kudosu').'">halaman ini</a> untuk informasi lebih lanjut.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Pengguna ini belum menerima kudosu!',

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Menerima :amount atas penolakan pencabutan kudosu di post modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Menolak :amount di post modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Kehilangan :amount atas penghapusan post di post modding :post',
                        ],

                        'restore' => [
                            'give' => 'Menerima :amount atas restorasi post di post modding :post',
                        ],

                        'vote' => [
                            'give' => 'Menerima :amount atas pemungutan suara di post modding :post',
                            'reset' => 'Kehilangan :amount atas pemungutan suara di post modding :post',
                        ],

                        'recalculate' => [
                            'give' => 'Menerima :amount atas penilaian ulang suara di post modding :post',
                            'reset' => 'Kehilangan :amount atas penilaian ulang suara di post modding :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Menerima :amount dari :giver untuk posting di :post',
                        'reset' => 'Kudosu disetel ulang oleh :giver untuk posting di :post',
                        'revoke' => 'Kudosu ditolak oleh :giver untuk posting di :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'saya!',
            ],
            'medals' => [
                'empty' => 'Pengguna ini belum mendapatkannya. ;_;',
                'title' => 'Medali',
            ],
            'recent_activity' => [
                'title' => 'Terbaru',
            ],
            'top_ranks' => [
                'empty' => 'Belum ada catatan performa yang luar biasa. :(',
                'not_ranked' => 'Hanya beatmap ranked yang dapat memberikan pp.',
                'pp' => ':amountpp',
                'title' => 'Peringkat',
                'weighted_pp' => 'Terhitung: :pp (:percentage)',

                'best' => [
                    'title' => 'Performa Terbaik',
                ],
                'first' => [
                    'title' => 'Peringkat Tempat Pertama',
                ],
            ],
            'account_standing' => [
                'title' => 'Kondisi Akun',
                'bad_standing' => 'Akun <strong>:username</strong> tidak dalam kondisi baik :(',
                'remaining_silence' => '<strong>:username</strong> akan dapat berbicara lagi dalam :duration.',

                'recent_infringements' => [
                    'title' => 'Pelanggaran Terbaru',
                    'date' => 'tanggal',
                    'action' => 'aksi',
                    'length' => 'durasi',
                    'length_permanent' => 'Permanen',
                    'description' => 'deskripsi',
                    'actor' => 'oleh :username',

                    'actions' => [
                        'restriction' => 'Blokir',
                        'silence' => 'Bungkam',
                        'note' => 'Catatan',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Minat',
            'lastfm' => 'Last.fm',
            'location' => 'Lokasi Saat Ini',
            'occupation' => 'Pekerjaan',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Pengguna mungkin telah mengubah nama penggunanya.',
            'reason_2' => 'Akun tersebut mungkin tidak tersedia untuk sementara karena masalah keamanan atau penyalahgunaan.',
            'reason_3' => 'Mungkin anda salah ketik!',
            'reason_header' => 'Ada beberapa kemungkinan mengapa hal ini bisa terjadi:',
            'title' => 'Pengguna tidak ditemukan! ;_;',
        ],
        'page' => [
            'description' => '<strong>saya!</strong> adalah area pribadi yang dapat dimodifikasi di halaman profil anda.',
            'edit_big' => 'Sunting saya!',
            'placeholder' => 'Ketik konten halaman di sini',
            'restriction_info' => "Anda harus menjadi <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> untuk membuka fitur ini.",
        ],
        'post_count' => [
            '_' => 'Berkontribusi :link',
            'count' => ':count postingan forum|:count postingan forum',
        ],
        'rank' => [
            'country' => 'Peringkat negara untuk :mode',
            'global' => 'Peringkat global untuk :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Akurasi Hit',
            'level' => 'Level :level',
            'maximum_combo' => 'Combo Maksimum',
            'play_count' => 'Jumlah Main',
            'play_time' => 'Jumlah Waktu Main',
            'ranked_score' => 'Skor Ranked',
            'replays_watched_by_others' => 'Tayangan ulang ditonton oleh orang lain',
            'score_ranks' => 'Peringkat Skor',
            'total_hits' => 'Total Hit',
            'total_score' => 'Total Skor',
        ],
    ],
    'status' => [
        'online' => 'Daring',
        'offline' => 'Luring',
    ],
    'store' => [
        'saved' => 'Pengguna dibuat',
    ],
    'verify' => [
        'title' => 'Verifikasi Akun',
    ],
];
