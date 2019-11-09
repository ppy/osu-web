<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[pengguna yang dihapus]',

    'beatmapset_activities' => [
        'title' => "Riwayat Modding :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Diskusi yang baru dimulai',
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

    'blocks' => [
        'banner_text' => 'Anda telah memblokir pengguna ini.',
        'blocked_count' => 'pengguna yang diblokir (:count)',
        'hide_profile' => 'sembunyikan profil',
        'not_blocked' => 'Pengguna tidak diblokir.',
        'show_profile' => 'tampilkan profil',
        'too_many' => 'Batas blokir tercapai.',
        'button' => [
            'block' => 'blokir',
            'unblock' => 'buka blokir',
        ],
    ],

    'card' => [
        'loading' => 'Memuat...',
        'send_message' => 'kirim pesan',
    ],

    'login' => [
        '_' => 'Masuk',
        'locked_ip' => 'Alamat IP Anda dikunci. Mohon tunggu beberapa menit.',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Sandi',
        'button' => 'Masuk',
        'button_posting' => 'Mencoba masuk...',
        'remember' => 'Ingat perangkat ini',
        'title' => 'Mohon masuk untuk melanjutkan',
        'failed' => 'Gagal masuk',
        'register' => "Belum memiliki akun osu!? Buat yang baru sekarang",
        'forgot' => 'Lupa kata sandi?',
        'beta' => [
            'main' => 'Akses beta saat ini dibatasi untuk pengguna istimewa.',
            'small' => '(osu!supporter akan segera masuk)',
        ],

        'here' => 'di sini', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Postingan :username',
    ],

    'anonymous' => [
        'login_link' => 'klik untuk masuk',
        'login_text' => 'masuk',
        'username' => 'Tamu',
        'error' => 'Anda perlu masuk untuk melakukan ini.',
    ],
    'logout_confirm' => 'Apa Anda yakin akan keluar? :(',
    'report' => [
        'button_text' => 'laporkan',
        'comments' => 'Komentar Tambahan',
        'placeholder' => 'Mohon berikan informasi apa pun yang Anda yakini dapat bermanfaat.',
        'reason' => 'Alasan',
        'thanks' => 'Terima kasih atas laporan Anda!',
        'title' => 'Laporkan :username?',

        'actions' => [
            'send' => 'Kirim Laporan',
            'cancel' => 'Batal',
        ],

        'options' => [
            'cheating' => 'Melakukan kecurangan',
            'insults' => 'Menghina saya / orang lain',
            'spam' => 'Spam',
            'unwanted_content' => 'Menautkan konten yang tidak pantas',
            'nonsense' => 'Berperilaku buruk',
            'other' => 'Lainnya (ketik di bawah)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Akun Anda telah dibatasi!',
        'message' => 'Selama dibatasi, Anda tidak dapat berinteraksi dengan pengguna lain dan skor hanya akan terlihat oleh Anda. Hal ini biasanya terproses secara otomatis dan akan diangkat dalam 24 jam. Jika Anda ingin mengajukan banding atas pembatasan Anda, mohon <a href="mailto:accounts@ppy.sh">hubungi layanan dukungan</a>.',
    ],
    'show' => [
        'age' => ':age tahun',
        'change_avatar' => 'ganti avatar Anda!',
        'first_members' => 'Di sini dari awal',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Bergabung :date',
        'lastvisit' => 'Terakhir terlihat :date',
        'lastvisit_online' => 'Saat ini online',
        'missingtext' => 'Mungkin Anda salah ketik! (atau pengguna mungkin telah diblokir)',
        'origin_country' => 'Dari :country',
        'page_description' => 'osu! - Segala sesuatu yang ingin Anda ketahui tentang :username!',
        'previous_usernames' => 'dulu dikenal sebagai',
        'plays_with' => 'Bermain menggunakan :devices',
        'title' => "profil :username",

        'edit' => [
            'cover' => [
                'button' => 'Ganti Sampul Profil',
                'defaults_info' => 'Pilihan sampul lainnya akan tersedia di masa mendatang',
                'upload' => [
                    'broken_file' => 'Gagal memproses gambar. Mohon periksa kembali gambar yang diunggah dan coba lagi.',
                    'button' => 'Unggah gambar',
                    'dropzone' => 'Letakkan di sini untuk mengunggah',
                    'dropzone_info' => 'Anda juga dapat meletakkan gambar Anda di sini untuk mengunggah.',
                    'size_info' => 'Ukuran gambar sampul yang optimal selayaknya adalah 2800x620',
                    'too_large' => 'File yang diunggah terlalu besar.',
                    'unsupported_format' => 'Format tidak didukung.',

                    'restriction_info' => [
                        '_' => 'Layanan unggah tersedia hanya untuk :link',
                        'link' => 'osu!supporter',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode permainan default',
                'set' => 'Atur :mode sebagai mode permainan default profil',
            ],
        ],

        'extra' => [
            'none' => 'kosong',
            'unranked' => 'Tidak ada rekam jejak permainan yang tercatat dalam beberapa waktu ke belakang',

            'achievements' => [
                'achieved-on' => 'Dicapai pada :date',
                'locked' => 'Terkunci',
                'title' => 'Pencapaian',
            ],
            'beatmaps' => [
                'by_artist' => 'oleh :artist',
                'none' => 'Saat ini belum ada...',
                'title' => 'Beatmap',

                'favourite' => [
                    'title' => 'Beatmap Favorit',
                ],
                'graveyard' => [
                    'title' => 'Beatmap Graveyarded',
                ],
                'loved' => [
                    'title' => 'Beatmap Loved',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Ranked & Approved',
                ],
                'unranked' => [
                    'title' => 'Beatmap Pending',
                ],
            ],
            'discussions' => [
                'title' => 'Diskusi',
                'title_longer' => 'Diskusi Terbaru',
                'show_more' => 'lihat lebih banyak diskusi',
            ],
            'events' => [
                'title' => 'Aktivitas',
                'title_longer' => 'Aktivitas Terakhir',
                'show_more' => 'lihat lebih banyak aktivitas',
            ],
            'historical' => [
                'empty' => 'Tidak ada catatan performa terbaru. :(',
                'title' => 'Historis',

                'monthly_playcounts' => [
                    'title' => 'Riwayat Main',
                    'count_label' => 'Kali Bermain',
                ],
                'most_played' => [
                    'count' => 'jumlah dimainkan',
                    'title' => 'Beatmap yang Paling Banyak Dimainkan',
                ],
                'recent_plays' => [
                    'accuracy' => 'akurasi: :percentage',
                    'title' => 'Permainan Terbaru (24 jam)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Riwayat Jumlah Tayangan Ulang yang Ditonton',
                    'count_label' => 'Kali Tayangan Ulang Ditonton',
                ],
            ],
            'kudosu' => [
                'available' => 'Jumlah Kudosu Tersedia',
                'available_info' => "Kudosu yang Anda miliki dapat ditukarkan menjadi bintang-bintang kudosu (kudosu stars) yang dapat membantu beatmap Anda untuk mendapatkan lebih banyak perhatian. Berikut jumlah kudosu yang belum Anda tukarkan.",
                'recent_entries' => 'Riwayat Kudosu Terbaru',
                'title' => 'Kudosu!',
                'total' => 'Jumlah Kudosu yang Diperoleh',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Pengguna ini belum menerima kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Menerima :amount atas pembatalan penolakan kudosu di post modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Menolak :amount di post modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Kehilangan :amount atas penghapusan post di post modding :post',
                        ],

                        'restore' => [
                            'give' => 'Menerima :amount atas pengembalian post di post modding :post',
                        ],

                        'vote' => [
                            'give' => 'Menerima :amount karena mendapatkan vote positif di post modding :post',
                            'reset' => 'Kehilangan :amount karena kehilangan vote positif di post modding :post',
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

                'total_info' => [
                    '_' => 'Berdasarkan seberapa besar kontribusi yang telah dilakukan pengguna dalam moderasi beatmap. Kunjungi :link untuk informasi lebih lanjut.',
                    'link' => 'laman ini',
                ],
            ],
            'me' => [
                'title' => 'saya!',
            ],
            'medals' => [
                'empty' => "Pengguna ini belum mendapatkannya. ;_;",
                'recent' => 'Terbaru',
                'title' => 'Medali',
            ],
            'posts' => [
                'title' => 'Posting',
                'title_longer' => 'Postingan Terbaru',
                'show_more' => 'lihat lebih banyak posting',
            ],
            'recent_activity' => [
                'title' => 'Terbaru',
            ],
            'top_ranks' => [
                'download_replay' => 'Unduh Replay',
                'empty' => 'Belum ada catatan performa yang mendapat peringkat pertama. :(',
                'not_ranked' => 'Hanya beatmap Ranked yang dapat memberikan pp.',
                'pp_weight' => 'terbobotkan sejumlah :percentage',
                'title' => 'Peringkat',

                'best' => [
                    'title' => 'Performa Terbaik',
                ],
                'first' => [
                    'title' => 'Peringkat Pertama',
                ],
            ],
            'votes' => [
                'given' => 'Suara Diberikan (3 bulan terakhir)',
                'received' => 'Suara Diterima (3 bulan terakhir)',
                'title' => 'Hak Suara',
                'title_longer' => 'Pilihan Terbaru',
                'vote_count' => ':count_delimited pilihan',
            ],
            'account_standing' => [
                'title' => 'Kondisi Akun',
                'bad_standing' => "Akun <strong>:username</strong> tidak dalam kondisi baik :(",
                'remaining_silence' => '<strong>:username</strong> akan dapat berbicara lagi dalam :duration.',

                'recent_infringements' => [
                    'title' => 'Pelanggaran Terbaru',
                    'date' => 'tanggal',
                    'action' => 'tindakan',
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

        'header_title' => [
            '_' => 'Pemain :info',
            'info' => 'Info',
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
            'reason_2' => 'Akun tersebut mungkin tidak tersedia untuk sementara waktu karena memiliki riwayat masalah yang berhubungan dengan keamanan atau penyalahgunaan akun.',
            'reason_3' => 'Mungkin Anda salah ketik!',
            'reason_header' => 'Ada beberapa kemungkinan mengapa hal ini bisa terjadi:',
            'title' => 'Pengguna tidak ditemukan! ;_;',
        ],
        'page' => [
            'button' => 'Sunting laman profil',
            'description' => '<strong>saya!</strong> adalah area pribadi yang dapat dimodifikasi di laman profil Anda.',
            'edit_big' => 'Sunting saya!',
            'placeholder' => 'Ketik konten laman di sini',

            'restriction_info' => [
                '_' => 'Kamu harus menjadi seorang :link untuk menggunakan fitur ini.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Berkontribusi sebanyak :link',
            'count' => ':count postingan forum',
        ],
        'rank' => [
            'country' => 'Peringkat negara untuk :mode',
            'country_simple' => 'Peringkat Negara',
            'global' => 'Peringkat global untuk :mode',
            'global_simple' => 'Peringkat Global',
        ],
        'stats' => [
            'hit_accuracy' => 'Akurasi Hit',
            'level' => 'Level :level',
            'level_progress' => 'Persentase pencapaian untuk menuju ke level selanjutnya',
            'maximum_combo' => 'Kombo Maksimum',
            'medals' => 'Jumlah Medali',
            'play_count' => 'Jumlah Main',
            'play_time' => 'Telah Bermain Selama',
            'ranked_score' => 'Skor Ranked',
            'replays_watched_by_others' => 'Jumlah Tayangan Ulang yang Ditonton',
            'score_ranks' => 'Peringkat Skor',
            'total_hits' => 'Jumlah Hit',
            'total_score' => 'Jumlah Skor',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Beatmap Ranked & Approved',
            'loved_beatmapset_count' => 'Beatmap Loved',
            'unranked_beatmapset_count' => 'Beatmap Pending',
            'graveyard_beatmapset_count' => 'Beatmap Graveyarded',
        ],
    ],

    'status' => [
        'all' => 'Semua',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Pengguna dibuat',
    ],
    'verify' => [
        'title' => 'Verifikasi Akun',
    ],

    'view_mode' => [
        'card' => 'Tampilan kartu',
        'list' => 'Tampilan daftar',
    ],
];
